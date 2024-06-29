<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>

</script>
<script src="../assets/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(() => {

        $("#formFile").change(function() {

            const file = this.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {

                    $("#imgPreview").attr("src", event.target.result);
                    $("#imPreview").style.visibility = visible;

                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
</body>

</html>