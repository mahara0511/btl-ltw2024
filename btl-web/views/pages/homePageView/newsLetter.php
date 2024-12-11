<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">

                <div class="newsletter">
                    <p>Sign Up for the <strong>OFFERUPDATES</strong></p>
                    <form id="offer_form" method="POST">
                        <input class="input" type="email" id="email" name="email" placeholder="Enter Your Email">
                        <button class="newsletter-btn" value="Sign Up" name="signup_button" type="submit"><i
                                class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <div class="" id="offer_msg">
                        <!--Alert from signup form-->
                    </div>
                    <ul class="newsletter-follow">
                        <li>
                            <a href=""><i class="fa-brands fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa-brands fa-instagram"></i> </a>
                        </li>
                        <li>
                            <a href=""><i class="fa-brands fa-github"></i> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<script> 
    // Lắng nghe sự kiện submit của form
document.getElementById("offer_form").addEventListener("submit", async function (e) {
    e.preventDefault(); // Ngăn trình duyệt tải lại trang

    // Thu thập dữ liệu từ form
    const email = document.getElementById("email").value;

    // Hiển thị thông báo đang xử lý
    const offerMsg = document.getElementById("offer_msg");

    if (email.trim() === "") {
        offerMsg.innerHTML = `<p style='color: red;'>Please enter a valid email address.</p>`;
        return;
    }

    try {
        // Gửi yêu cầu POST tới API
        const response = await fetch("/subcribe", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ email: email }),
        });

        const result = await response.json();

        if (response.ok) {
            if(result.status == "success") {
                offerMsg.innerHTML = `<p style='color: green;'>${result.message || "Subscription successful! Thank you for signing up."}</p>`;
            } else {
                offerMsg.innerHTML = `<p style='color: yellow;'>${result.message || "Subscription successful! Thank you for signing up."}</p>`;

            }
        } else {
            offerMsg.innerHTML = `<p style='color: yellow;'>${result.error || "An error occurred."}</p>`;
        }
    } catch (error) {
        offerMsg.innerHTML = `<p style='color: yellow;'>Error: ${error.message}</p>`;
    }

    // Reset form sau khi xử lý
    document.getElementById("offer_form").reset();
});

</script>