console.log("____app js");
axios.defaults.withCredentials = true;

const baseUrl = window.location.origin;
const apiHeaders = {
    headers: {
        Accept: "*/*",
        "Access-Control-Allow-Origin": "*",
        "Content-Type": "multipart/form-data",
    },
};

function randomIntFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function breakWord(text) {
    if (typeof text !== "string" || !text.trim()) {
        console.warn("breakWord: input tidak valid:", text);
        return "";
    }

    let array = text.split(" ");
    let len = 2;

    var newtext = "";
    for (let i = 0; i < array.length; i++) {
        newtext += array[i];
        if (i % len == 0) {
            newtext += "<br>";
        } else {
            newtext += " ";
        }
    }
    return newtext;
}

function getCookie(name) {
    let value = "; " + document.cookie;
    let parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

// === LOGOUT ===
$("#logout-btn").on("click", function () {
    const token = getCookie("ut");
    console.log("Token dari cookie:", token);
    if (!token) {
        Swal.fire({
            icon: "error",
            title: "No token found",
        });
        return;
    }

        const headers = {
            headers: {
                Authorization: token ? "Bearer " + token : "",
                Accept: "application/json",
            },
        };


    axios
        .post(baseUrl + "/api/auth/logout", {}, headers)
        .then((res) => {
            console.log("Logout success:", res.data);
            document.cookie =
                "ut=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie =
                "ue=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Logged out successfully",
                showConfirmButton: false,
                timer: 1500,
            });
            setTimeout(() => {
                window.location = baseUrl;
            }, 1500);
        })
        .catch((err) => {
            console.error("Logout error:", err);
            Swal.fire({
                icon: "error",
                title: "Failed to logout",
                html: err.response ? err.response.data.message : err.message,
            });
        });
});

// === LOGIN === (Tunggu sampai form tersedia)
const waitForFormLogin = setInterval(function () {
    const form = document.getElementById("form-login");
    const btn = document.getElementById("form-login-btn");

    if (form && btn) {
        clearInterval(waitForFormLogin);

        btn.addEventListener("click", function () {
            if (!form.checkValidity()) {
                form.reportValidity();
            } else {
                $("#form-login-error").html("");
                $("#form-login-loading").show();
                $("#form-login").hide();

                let url = baseUrl + "/api/user/login";
                let formData = new FormData(form);

                axios
                    .post(url, formData, apiHeaders)
                    .then(function (response) {
                        console.log("[DATA] response...", response.data);

                        // Set cookies
                        document.cookie =
                            "ut=" + response.data.token + "; path=/;";
                        document.cookie =
                            "ue=" + formData.get("email") + "; path=/;";

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Login successfully",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        setTimeout(function () {
                            window.location = baseUrl;
                        }, 1500);
                    })
                    .catch(function (error) {
                        console.log("[ERROR] response...", error);
                        $("#form-login-error").html(
                            error.response
                                ? error.response.data.message
                                : error.message
                        );
                        $("#form-login-loading").hide();
                        $("#form-login").show();
                    });
            }
        });
    }
}, 100);

// === REGISTER ===
$("#form-register-btn").on("click", function () {
    const form = document.getElementById("form-register");

    if (!form.checkValidity()) {
        form.reportValidity();
    } else {
        $("#form-register-error").html("");
        $("#form-register-loading").show();
        $("#form-register").hide();

        let url = baseUrl + "/api/user/register";
        let formData = new FormData(form);

        axios
            .post(url, formData, apiHeaders)
            .then(function (response) {
                console.log("[DATA] response...", response.data);

                document.cookie = "ue=" + formData.get("email") + "; path=/;";
                document.cookie = "ut=" + response.data.token + "; path=/;";

                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Registered successfully and logged in automatically",
                    showConfirmButton: false,
                    timer: 1500,
                });

                setTimeout(function () {
                    window.location = baseUrl;
                }, 1500);
            })
            .catch(function (error) {
                console.log("[ERROR] response...", error);
                $("#form-register-error").html(
                    error.response ? error.response.data.message : error.message
                );
                $("#form-register-loading").hide();
                $("#form-register").show();
            });
    }
});





