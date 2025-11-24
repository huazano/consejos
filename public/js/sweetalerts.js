Livewire.on("alert", function (message) {
    if (Array.isArray(message)) {
        if (message.length > 1) {
            if (message[1] == "success") {
                Swal.fire("¡Excelente!", message[0], message[1]);
            } else if (message[1] == "error") {
                Swal.fire("¡Ocurrio un error!", message[0], message[1]);
            } else if (message[1] == "warning") {
                Swal.fire("¡Advertencia!", message[0], message[1]);
            } else if (message[1] == "info") {
                Swal.fire("¡Información!", message[0], message[1]);
            } else if (message[1] == "question") {
                Swal.fire("¡Espera un momento!", message[0], message[1]);
            }
        } else {
            Swal.fire("¡Excelente!", message[0], "success");
        }
    } else {
        Swal.fire("¡Excelente!", message, "success");
    }
});

Livewire.on("alert_confirmation", function (data) {
    Swal.fire({
        title: data.title,
        input: "text",
        inputAttributes: {
            autocapitalize: "on",
        },
        inputLabel: "Escribe la palabra " + data.word + " para confirmar.",
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            if (value != data.word) {
                return "¡Debes escribir la palabra " + data.word + "!";
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(data.emitTo);
            Livewire.emitTo(data.emitTo, data.callback, data.id);
        }
    });
});

Livewire.on("alert_date", function (data) {
    timeElapsed = Date.now();
    timeElapsed.toLocaleString("en-US", { timeZone: "America/Mexico_City" });
    today = new Date(timeElapsed);
    today =
        today.toISOString().split(".")[0].split(":")[0] +
        ":" +
        today.toISOString().split(".")[0].split(":")[1];
    Swal.fire({
        title: data.title,
        html: "<input id='xy' type='datetime-local' value='" + today + "'>",
        inputAttributes: {
            autocapitalize: "on",
        },
        inputLabel: "Escribe la palabra " + data.word + " para confirmar.",
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            console.log(data.emitTo);
            Livewire.emitTo(data.emitTo, data.callback, [
                document.getElementById("xy").value,
                data.id,
            ]);
        }
    });
});

Livewire.on("alert_message", function (data) {
    Swal.fire({
        title: data.title,
        input: "text",
        inputAttributes: {
            autocapitalize: "on",
        },
        inputLabel: "Escribe " + data.word + ".",
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            if (value == "") {
                return "¡Debes escribir " + data.word + "!";
            }
        },
        allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.emitTo(data.emitTo, data.callback, data.id, result.value);
        }
    });
});
