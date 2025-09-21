document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("btnMoreInfo");
    if (!btn) return;

    btn.addEventListener("click", function () {
        const productId = this.getAttribute("data-id");
        const descDiv = document.getElementById("aiDescription");
        descDiv.innerHTML = "<span class='text-info'>Loading more info...</span>";

        fetch(`/products/${productId}/more-info`)
            .then(response => response.json())
            .then(data => {
                if (data.description) {
                    descDiv.innerHTML = data.description; // 👈 ahora es HTML
                } else {
                    descDiv.innerHTML = "<span class='text-danger'>Error loading description.</span>";
                }
            })
            .catch(() => {
                descDiv.innerHTML = "<span class='text-danger'>Error connecting to AI service.</span>";
            });
    });
});
