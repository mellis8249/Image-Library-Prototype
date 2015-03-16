        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="javascript/tabs.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
            //build dropdown

            $("<select />").appendTo(".header nav");
            $("<option />", {
            "selected": "selected",
            "value"   : "",
            "text"    : "Go to..."
            }).appendTo(".header select");

            $(".header nav li a").each(function() {
            var el = $(this);
            $("<option />", {
            "value"   : el.attr("href"),
            "text"    : el.text()
            }).appendTo(".header select");

            });

            $("header select").change(function() {
            window.location = $(this).find("option:selected").val();
            });

        });
        </script>