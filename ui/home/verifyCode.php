<?php
if (PHP_SESSION_NONE === session_status()) {
    session_start();
}
?>
<body>
<div class="container p-4 bg-white rounded shadow text-center" style="max-width: 450px;">
    <div class="mb-4">
        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
            <i class="fas fa-shield-alt fa-2x"></i>
        </div>
        <h1 class="h4 fw-bold">Verificación de Código</h1>
        <p class="text-muted">Hemos enviado un código de 6 dígitos a tu correo electrónico. Introdúcelo a continuación para verificar tu identidad.</p>
    </div>

    <form id="verificationForm" action="<?= "?pid=" . base64_encode("ui/home/modalVerify.php")?>" method="POST">
        <div class="d-flex justify-content-center gap-2 mb-3">
            <input type="text" class="form-control code-digit" maxlength="1" inputmode="numeric" data-index="0">
            <input type="text" class="form-control code-digit" maxlength="1" inputmode="numeric" data-index="1">
            <input type="text" class="form-control code-digit" maxlength="1" inputmode="numeric" data-index="2">
            <input type="text" class="form-control code-digit" maxlength="1" inputmode="numeric" data-index="3">
            <input type="text" class="form-control code-digit" maxlength="1" inputmode="numeric" data-index="4">
            <input type="text" class="form-control code-digit" maxlength="1" inputmode="numeric" data-index="5">
        </div>

        <div id="statusMessage" class="text-muted small d-flex align-items-center justify-content-center gap-2 mb-3">
            <i class="fas fa-info-circle"></i>
            <span>Ingresa los 6 dígitos del código</span>
        </div>

        
        <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center gap-2" id="verifyBtn" name="verifyCode" disabled>
            <span>Verificar Código</span>
            <div class="spinner d-none" id="spinner"></div>
        </button>
    </form>

    <div class="mt-4 pt-3 border-top">
        <p class="text-muted mb-1">¿No recibiste el código?</p>
        <button type="button" class="btn btn-link p-0" id="resendBtn">Reenviar código</button>
    </div>
</div>
<script>
$(document).ready(function () {
    const $inputs = $('.code-digit');
    const $verifyBtn = $('#verifyBtn');
    const $statusMessage = $('#statusMessage');
    const $resendBtn = $('#resendBtn');
    const $spinner = $('#spinner');
    const verificationCode = "<?= $_SESSION["verificationCode"] ?>"; // Esto es solo para simulación
    const totalDigits = 6;

    let resendInterval;
    let resendCountdown = 0;

    function updateStatus(type = '', message = '', icon = 'fas fa-info-circle') {
        const classMap = {
            success: 'text-success',
            error: 'text-danger',
            '': 'text-muted'
        };
        $statusMessage
            .removeClass('text-success text-danger text-muted')
            .addClass(classMap[type])
            .html(`<i class="${icon}"></i><span class="ms-2">${message}</span>`);
    }

    function getCodeFromInputs() {
        return $inputs.map((_, el) => $(el).val().trim()).get().join('');
    }

    function validateInputs() {
        let allFilled = true;
        $inputs.each(function () {
            const isDigit = /^\d$/.test($(this).val());
            $(this).toggleClass('is-valid', isDigit);
            $(this).toggleClass('is-invalid', !isDigit);
            if (!isDigit) allFilled = false;
        });

        const code = getCodeFromInputs();
        if (code.length === totalDigits) {
            $verifyBtn.prop('disabled', false);
            updateStatus('success', '¡Código completo! Listo para verificar', 'fas fa-check-circle');
        } else if (code.length > 0) {
            $verifyBtn.prop('disabled', true);
            updateStatus('', `Código incompleto (${code.length}/${totalDigits})`, 'fas fa-clock');
        } else {
            $verifyBtn.prop('disabled', true);
            updateStatus('', 'Ingresa los 6 dígitos del código');
        }
    }

    $inputs.on('input', function () {
        const $this = $(this);
        const index = $inputs.index($this);
        $this.val($this.val().replace(/[^0-9]/g, ''));
        if ($this.val() && index < totalDigits - 1) {
            $inputs.eq(index + 1).focus();
        }
        validateInputs();
    });

    $inputs.on('keydown', function (e) {
        const index = $inputs.index(this);
        if (e.key === 'Backspace' && !$(this).val() && index > 0) {
            $inputs.eq(index - 1).focus();
        } else if (e.key === 'ArrowLeft' && index > 0) {
            $inputs.eq(index - 1).focus();
        } else if (e.key === 'ArrowRight' && index < totalDigits - 1) {
            $inputs.eq(index + 1).focus();
        }
    });

    $inputs.on('paste', function (e) {
        e.preventDefault();
        const pasted = (e.originalEvent.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, totalDigits);
        [...pasted].forEach((digit, i) => $inputs.eq(i).val(digit));
        validateInputs();
        $inputs.eq(Math.min(pasted.length, totalDigits - 1)).focus();
    });

    $inputs.on('focus', function () {
        $(this).select();
    });

    $('#verificationForm').on('submit', function (e) {
        e.preventDefault();
        const code = getCodeFromInputs();

        if (code.length !== totalDigits) {
            updateStatus('error', 'Por favor, completa todos los dígitos', 'fas fa-exclamation-triangle');
            $inputs.each(function () {
                if (!$(this).val()) $(this).addClass('is-invalid');
            });
            return;
        }

        $verifyBtn.prop('disabled', true);
        $spinner.removeClass('d-none');
        updateStatus('', 'Verificando código...', 'fas fa-spinner fa-spin');

        setTimeout(() => {
            const isSuccess = code === verificationCode;
            console.log(isSuccess ? 'Código correcto' : 'Código incorrecto');
            if (isSuccess) {
                updateStatus('success', '¡Código verificado correctamente!', 'fas fa-check-circle');
                $('.container').addClass('animate__animated animate__pulse');
                setTimeout(() => {
                    // $(this).off('submit').submit();
                }, 1000);
                window.location.href = "?pid=" + btoa("ui/home/home.php");
            } else {
                updateStatus('error', 'Código incorrecto. Inténtalo de nuevo.', 'fas fa-times-circle');
                $inputs.val('').removeClass('is-valid').addClass('is-invalid');
                $inputs.first().focus();
                $verifyBtn.prop('disabled', false);
                $spinner.addClass('d-none');
            }
        }, 1500);
    });

    function startResendCountdown() {
        resendCountdown = 60;
        $resendBtn.prop('disabled', true);
        resendInterval = setInterval(() => {
            resendCountdown--;
            $resendBtn.html(`Reenviar código <span class="text-warning fw-bold">(${resendCountdown}s)</span>`);
            if (resendCountdown <= 0) {
                clearInterval(resendInterval);
                $resendBtn.prop('disabled', false).html('Reenviar código');
            }
        }, 1000);
    }

    $resendBtn.on('click', function () {
        updateStatus('success', 'Código reenviado a tu correo electrónico', 'fas fa-paper-plane');
        startResendCountdown();
        $inputs.val('').removeClass('is-valid is-invalid');
        $inputs.first().focus();
        validateInputs();
    });

    // Inicial
    $inputs.first().focus();
    startResendCountdown();
});

</script>
<style>
body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.code-digit {
    width: 50px;
    height: 60px;
    font-size: 1.5rem;
    text-align: center;
}
.spinner {
    width: 1rem;
    height: 1rem;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
</body>
