 
<div class="wrapper two">            
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="width:100%;"><?= $model->title ?></h3>
            <small><?= $model->postCategory->ime ?></small>
        </div>  
        <img src="http://www.teamstudio.com/Portals/218295/images/istock_000001242290small.jpg" class="img-responsive"/>
        <div class="panel-body">
            <p><?= substr($model->body, 0, 500) ?></p>
        </div>
        <div class="panel-footer">
            <a class="btn btn-primary pull-right" href="#">
                Read more
            </a>
        </div>
    </div>
</div>