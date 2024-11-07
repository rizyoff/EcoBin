// More API functions here:
// https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

// the link to your model provided by Teachable Machine export panel
const URL = "https://teachablemachine.withgoogle.com/models/oC1Na2nrd/";

let model, webcam, labelContainer, maxPredictions;

// Load the image model and setup the webcam
async function init() {
    document.getElementById("frame_foto").style.display = "none";

    const modelURL = URL + "model.json";
    const metadataURL = URL + "metadata.json";

    // load the model and metadata
    // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
    // or files from your local hard drive
    // Note: the pose library adds "tmImage" object to your window (window.tmImage)
    model = await tmImage.load(modelURL, metadataURL);
    maxPredictions = model.getTotalClasses();

    // Convenience function to setup a webcam
    const flip = true; // whether to flip the webcam
    webcam = new tmImage.Webcam(600, 500, flip); // width, height, flip
    await webcam.setup(); // request access to the webcam
    await webcam.play();
    window.requestAnimationFrame(loop);

    // append elements to the DOM
    document.getElementById("webcam-container").appendChild(webcam.canvas);
    labelContainer = document.getElementById("label-container");
    for (let i = 0; i < maxPredictions; i++) {
        // and class labels
        labelContainer.appendChild(document.createElement("div"));
    }
}

async function loop() {
    webcam.update(); // update the webcam frame
    await predict();
    window.requestAnimationFrame(loop);
}

//mematikan kamera dan menampilkan hasilnya

// run the webcam image through the image model
async function predict() {
    const prediction = await model.predict(webcam.canvas);
    for (let i = 0; i < maxPredictions; i++) {
        const probability = prediction[i].probability;
        const className = prediction[i].className;
        const classPrediction = `${className}: ${probability.toFixed(2)}`;
        // labelContainer.childNodes[i].innerHTML = classPrediction;

        // Jika salah satu probabilitas lebih dari 75%, tampilkan hasilnya dan hentikan scan
        if (probability > 0.75) {
            document.getElementById("result").innerHTML = `Hasil: ${className}`;
            // keluar dari loop setelah menemukan hasil yang sesuai
            document.getElementById("jenis-sampah").value = className;
        }
    }
}

function stopScan() {
    if (webcam) {
        webcam.stop(); // stop the webcam
        document.getElementById("webcam-container").innerHTML = ""; // remove webcam canvas from DOM
        window.cancelAnimationFrame(loop); // stop the animation loop
        document.getElementById("frame_foto").style.display = "block";
        document.getElementById("popupOverlay").style.display = "flex";
    }
}

function back() {
    document.getElementById("popupOverlay").style.display = "none";
}

document.getElementById("PointForm").addEventListener("submit", function (event) {event.preventDefault(); // Mencegah halaman refresh

        // Ambil nilai dari input
        let berat = document.getElementById("number-berat").value;
        let userId = document.getElementById("user_id").value;
        // Kirim data ke server menggunakan fetch
        fetch("/update-point", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}", // Token CSRF Laravel
            },
            body: JSON.stringify({
                user_id: userId,
                point: berat * 10, // Contoh konversi berat ke point
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    alert("Point berhasil diperbarui!");
                    // Tutup pop-up atau lakukan aksi lain
                } else {
                    alert("Terjadi kesalahan.");
                }
            })
            .catch((error) => console.error("Error:", error));
    });

let nominal = 0;

function confirmReedem(nominalPenukaran) {
    nominal = nominalPenukaran;
    document.getElementsByid("nominal").innerText = nominal;
    $("#confirmationModal").modal("show");
}

function proceedReedem() {
    $.ajax({
        url: "{{ route('reedem.point') }}",
        method: "POST",
        data: {
            nominal: nominal,
            _token: "{{ csrf_token() }}",
        },
        success: function(response) {
            $('#confirmationModal').modal('hide');

            let responseMessage = $('#responseMessage');
            responseMessage.show();

            if (response.status === 'success') {
                responseMessage.removeClass('alert-danger').addClass('alert-success').text(response.message);
                window.location.href = '/reedem';
            } else if (response.status === 'error') {
                responseMessage.removeClass('alert-success').addClass('alert-danger').text(response.message);
                window.location.href = '/reedem';
            }
        },
        error: function() {
            alert('Terjadi kesalahan. Coba lagi.');
        }
    });
}
