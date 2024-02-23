<form action="../src/controlleur/sendMessage.php" method="post">
    <div class="container">
        <div class="white-block mt-5">
            <h2 class="title my-auto"><?= $translations['contact us']; ?></h2>
        </div>

        <label for="name" class="titles-form"><?= $translations['name']; ?></label>
        <input id="name" placeholder="<?= $translations['name']; ?>" type="text" name="name">

        <label for="mail" class="titles-form"><?= $translations['mail address']; ?></label>
        <input id="mail" placeholder="<?= $translations['mail address']; ?>" type="mail" name="mail">

        <label for="subject" class="titles-form"><?= $translations['subject']; ?></label>
        <input id="subject" placeholder="<?= $translations['subject']; ?>" type="text" name="subject">

        <label for="message" class="titles-form"><?= $translations['message']; ?></label>
        <textarea id="message" placeholder="<?= $translations['message']; ?>" name="main"></textarea>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="black-button">
                <h2 class="m-auto"><?= $translations['send']; ?></h2>
            </button>
        </div>

    </div>
</form>