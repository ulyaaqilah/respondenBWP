import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    // Fungsi untuk pesan sukses
    const successAlert = document.querySelector(".success-message");
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = "opacity 0.5s ease";
            successAlert.style.opacity = "0";
            setTimeout(() => successAlert.remove(), 500);
        }, 5000);
    }

    // Logika untuk Load More
    const loadMoreBtn = document.getElementById("load-more-btn");
    const feedbackList = document.getElementById("feedback-list");
    let skip = 3; // Mulai dengan melewati 3 ulasan pertama

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", async function () {
            this.textContent = "Loading...";
            this.disabled = true;

            try {
                const response = await fetch(`/load-more-ulasan?skip=${skip}`);
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const newUlasan = await response.json();

                if (newUlasan.length > 0) {
                    newUlasan.forEach((ulasan) => {
                        const reviewCard = createReviewCard(ulasan);
                        feedbackList.insertAdjacentHTML(
                            "beforeend",
                            reviewCard
                        );
                    });

                    skip += newUlasan.length;

                    if (newUlasan.length < 3) {
                        this.remove();
                    } else {
                        this.textContent = "Load More";
                        this.disabled = false;
                    }
                } else {
                    this.remove();
                }
            } catch (error) {
                console.error("Gagal memuat ulasan:", error);
                this.textContent = "Gagal Memuat";
            }
        });
    }

    // PERUBAHAN UTAMA ADA DI FUNGSI INI
    function createReviewCard(ulasan) {
        let stars = "";
        for (let i = 1; i <= 5; i++) {
            stars += `<i class="fa fa-star star-icon ${
                i <= ulasan.rating ? "filled" : ""
            }"></i>`;
        }

        const encodedName = encodeURIComponent(ulasan.nama);

        // Variabel untuk menampung HTML balasan (jika ada)
        let adminReplyHtml = "";
        if (ulasan.balasan) {
            adminReplyHtml = `
                <div class="admin-reply">
                    <strong>Balasan Admin:</strong>
                    <p>${ulasan.balasan}</p>
                </div>
            `;
        }

        return `
            <div class="review-card">
                <div class="review-card-header">
                    <img src="https://ui-avatars.com/api/?name=${encodedName}&background=ffc107&color=fff" alt="Avatar" class="avatar">
                    <div class="review-card-info">
                        <strong>${ulasan.nama}</strong>
                        <div class="review-stars">
                            ${stars}
                        </div>
                    </div>
                </div>
                <p>${ulasan.komentar}</p>
                ${adminReplyHtml} </div>
        `;
    }
});
