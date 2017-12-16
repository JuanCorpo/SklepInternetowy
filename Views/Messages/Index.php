<?php
function MessagesIndexView($controller, $model)
{
    ?>
    <form class="form-horizontal" method="post" action="/Messages/SendMailPost">
        <fieldset>
            <legend>Wyślij email</legend>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="inputTitle" id="inputText" placeholder="Title">
                </div>
            </div>

            <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="3" name="inputBody" id="textArea"></textarea>
                    <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                </div>
            </div>


            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </fieldset>
    </form>
    <?php
}