<form action="<?=URLROOT?>api/register" method="post" class="navbar-form navbar-right">
    <div class="form-group">
        <input type="text" name="login" class="form-control" placeholder="login" value="">
    </div>
    <div class="form-group">
        <input type="password" name="pass" class="form-control"  placeholder="pass" value="">
    </div>
    <div class="form-group">
        <input type="password" name="pass2" class="form-control"  placeholder="pass" value="">
    </div>
    <div class="form-group">
        <input type="email" name="mail" class="form-control"  placeholder="e-mail" value="">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-sign-in"></i> ENTER
    </button>
</form>