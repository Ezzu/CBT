@if (isset($_COOKIE['count']))
    @for($i=1;$i<=$_COOKIE['count'];$i++)
        <?php unset($_COOKIE['option'.$i]);
        setcookie('option'.$i, null, -1, '/');?>
    @endfor
@endif