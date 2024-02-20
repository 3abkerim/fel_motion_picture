<form action="../src/controlleur/sendMessage.php" method="post">
    <div class="container">
        <div class="white-block mt-5">
            <h2 class="title my-auto">contact us</h2>
        </div>

        <label for="name" class="titles-form">Name</label>
        <input id="name" placeholder="NAME" type="text" name="name">

        <label for="mail" class="titles-form">Mail address</label>
        <input id="mail" placeholder="MAIL ADDRESS" type="mail" name="mail">

        <label for="subject" class="titles-form">subject</label>
        <input id="subject" placeholder="SUBJECT" type="text" name="subject">

        <label for="message" class="titles-form">Message</label>
        <textarea id="message" placeholder="MESSAGE" name="main"></textarea>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="black-button">
                <h2 class="m-auto">send</h2>
            </button>
        </div>

    </div>
</form>