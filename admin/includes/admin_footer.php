
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            }
        } )
        .catch( error => {
            console.log( error );
        } );

        $(document).ready(function(){
            
            $('#selectAllBoxes').click(function(event){

                if(this.checked) {
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                } else {
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                    });
                }

            });

            var div_box = `<div id="load-screen"><div id="loading"></div></div>`;

            $("body").prepend(div_box);

            $('#load-screen').delay(700).fadeOut(600, function(){
                $(this).remove();
            });




        });

        function loadUsersOnline(){

            $.get("functions.php?onlineusers=result", function(data){

            $(".usersonline").text(data);

            });

        }

        setInterval(() => {

        loadUsersOnline();

        }, 500);


</script>

</body>

</html>
