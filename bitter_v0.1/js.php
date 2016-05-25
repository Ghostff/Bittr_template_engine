<?php
if (!defined('INDEX')) header('location: 404.html');
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/typed.js"></script>
<script>
    $(function(){
        $("#typed").typed({
            stringsElement: $('#typed-strings'),
            typeSpeed: 100,
            backDelay: 800,
            loop: false,
            loopCount: false,
            callback: function(){ foo(); },
            resetCallback: function() { newTyped(); }
        });
        $(".reset").click(function(){
            $("#typed").typed('reset');
        });
    });
    </script>
</body>
</html>
