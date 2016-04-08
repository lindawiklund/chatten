<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
            $("#panel").slideToggle("slow");
            });
        });
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chat</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
        // frågar användaren om ett namn i popup-ruta
        var name = prompt("Skriv ditt namn:", "Gäst");
            // Förvalt namn är 'Gäst'
            if (!name || name === ' ') {
                name = "Gäst";
            }
        // strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");
        // visar namn på sidan
        $("#name-area").html("Du är: <span>" + name + "</span>");
        // startar chat
        var chat =  new Chat();
    	$(function() {
            chat.getState(); 
            // watch textarea for key presses
            $("#sendie").keydown(function(event) {  
                var key = event.which;  
                //all keys including return 
                if (key >= 33) {
                    var maxLength = $(this).attr("maxlength");  
                    var length = this.value.length;  
                    // don't allow new content if length is maxed out
                    if (length >= maxLength) { 
                        event.preventDefault();  
                    }  
                }
            });
            // watch textarea for release of key press
            $('#sendie').keyup(function(e) {
                if (e.keyCode == 13) {
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                    // send 
                    if (length <= maxLength + 1) {
                        chat.send(text, name);	
    			        $(this).val("");
                    } 
                    else {
                        $(this).val(text.substring(0, maxLength));
                    }
                }
            });
        });
    </script>

</head>
<body onload="setInterval('chat.update()', 1000)">
    <div id="stor">
        <div id="flip">Chatta med kundtjänst</div>
        <div id="panel">
            <div id="page-wrap">
                <p id="name-area"></p>
                <div id="chat-wrap">
                    <div id="chat-area"></div>
                </div>
                <form id="send-message-area">
                    <p>Skriv här: </p>
                    <textarea id="sendie" maxlength = '100' ></textarea>
                    <input type="text" id="sendie" name="sendie" maxlenght='150'>
                    <input type="submit" id="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
