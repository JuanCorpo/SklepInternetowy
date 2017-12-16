<?php
function AboutIndexView($controller, $model)
{
    echo '
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-8">
                <h2>About - Index</h2>
            </div>
    
            <div class="col-sm-4 text-right cs-btn-toolbar">
                <a href="/About/Add" class="btn btn-primary">Add</a>
            </div>
        
        </div>
    </div>

    <hr>
    
    ';

    _CustomTable($model);
}