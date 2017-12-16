<?php
function AboutAddView()
{

    echo '

<form class="form-horizontal" method="post" action="/About/AddPost">
  <fieldset>
    <legend>Legend</legend>
    
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">True/False</label>
      <div class="col-lg-10">
        
        <div class="checkbox">
          <label>
            <input id="bool" type="checkbox" name="bool"> Checkbox
          </label>
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Textarea</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea" type="text" name="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
    
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Selects</label>
      <div class="col-lg-10">
        <select class="form-control" name="select" id="select">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a href="/About/Index" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>

';

}