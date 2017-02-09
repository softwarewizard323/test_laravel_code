<div id="toPopup">

    <div class="close"></div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup_content"> <!--your content start-->
        <form action="{{ url('/contact') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <ul>
                <li>
                    <label class="labeling" for="first_name">Your Name *</label>
                    <div style="float: left;">
                        <input class="field" type="text" name="first_name" maxlength="40" size="30" id="senderName" placeholder="Please type your name" required>
                        <div class="errors first_name"></div>
                    </div>
                    <div class="clear"></div>
                </li>

                <li>
                    <label class="labeling" for="email">Your Email Address *</label>
                    <div style="float: left;">
                        <input class="field" type="email" name="email" maxlength="60" id="senderEmail" style="width:495px" placeholder="Please type your email address" required>
                        <div class="errors email"></div>
                    </div>
                    <div class="clear"></div>
                </li>

                <li>
                    <label class="labeling" for="comments">Your Message *</label>
                    <div style="float: left;">
                        <textarea class="field" name="comments" id="message" placeholder="Please type your message" cols="20" rows="15" maxlength="10000" required></textarea>
                        <div class="errors comments"></div>
                    </div>
                    <div class="clear"></div>
                </li>

                <li>
                    <div class="labeling">*</div>
                    <div style="width: 400px; float: left;">
                        {!! Recaptcha::render() !!}
                        <div class="errors g-recaptcha-response"></div>
                    </div>
                </li>
            </ul>

            <div id="formButtons">
                <button type="submit" id="sendMessage" class="contactSendBtn" name="sendMessage" value="Submit">Send</button>
            </div>
        </form>
    </div> <!--your content end-->
</div> <!--toPopup end-->

<div id="backgroundPopup"></div>

<style>
    .errors { color: red; }
</style>

<script>
    $('form', '#popup_content').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        $('.errors').empty();
        $.ajax( {
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function (response) {
                alert(response.message);
                window.location.href = response.redirect
            },
            error: function (response) {
                $.each(response.responseJSON, function (index, elem) {
                    var item = $('.'+index);
                    item.text(elem);
                });
                grecaptcha.reset();
            }
        });
    });
</script>