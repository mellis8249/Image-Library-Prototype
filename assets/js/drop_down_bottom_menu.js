        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="javascript/tabs.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
            //build dropdown

            $("<select />").appendTo(".footer nav");
            $("<option />", {
            "selected": "selected",
            "value"   : "",
            "text"    : "Go to..."
            }).appendTo(".footer select");

            $(".footer nav li a").each(function() {
            var el = $(this);
            $("<option />", {
            "value"   : el.attr("href"),
            "text"    : el.text()
            }).appendTo(".footer select");

            });

            $("nav select").change(function() {
            window.location = $(this).find("option:selected").val();
            });

        });
        </script>