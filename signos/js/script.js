/**
 * script.js
 * Validação do formulário da página inicial do projeto "Descubra seu Signo".
 */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formSigno');
    const inputData = document.getElementById('data_nascimento');

    if (!form || !inputData) {
        return;
    }

    // Impede que o usuário selecione uma data futura
    const hoje = new Date();
    const anoHoje = hoje.getFullYear();
    const mesHoje = String(hoje.getMonth() + 1).padStart(2, '0');
    const diaHoje = String(hoje.getDate()).padStart(2, '0');
    inputData.setAttribute('max', `${anoHoje}-${mesHoje}-${diaHoje}`);

    form.addEventListener('submit', function (evento) {
        const valor = inputData.value;
        let valido = true;

        if (!valor) {
            valido = false;
        } else {
            const dataSelecionada = new Date(valor + 'T00:00:00');
            if (isNaN(dataSelecionada.getTime()) || dataSelecionada > hoje) {
                valido = false;
            }
        }

        if (!valido) {
            evento.preventDefault();
            inputData.classList.add('is-invalid');
            form.classList.add('was-validated-manual');
            inputData.focus();
        } else {
            inputData.classList.remove('is-invalid');
        }
    });

    // Remove o estado de erro assim que o usuário corrigir a data
    inputData.addEventListener('input', function () {
        if (inputData.value) {
            inputData.classList.remove('is-invalid');
        }
    });
});
