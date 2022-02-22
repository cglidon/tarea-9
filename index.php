<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
        section{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-size: 1.2em;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid black;
            box-shadow: 2px 2px 1px black;
            width: 500px;
            height: auto;
        }
        form input{
            width: 70%;
            background: rgba(10,150,250,0.2);
            font-size: 1.2em;
        }
</style>
    <script>
        //Función JavaScript/Ajax que se ejecuta en cada llamada 
        function mostrar_sugerencias(str){
            if(str.length==0){
                //Muestra el apartado de sugerencias vacio
                document.getElementById("sugerencias").innerHTML="";
                return;
            }else{
                //Si se ha insertado algún término ejecutamos Ajax..
                //Creamos un nuevo objeto asynReques de tipo XMLh 
                var asyncRequest = new XMLHttpRequest();
                //Registramos el controlador de eventos
                asyncRequest.onreadystatechange = stateChange;
                //Preparamos la solicitud de conexión para enviar a través del método GET. 
                asyncRequest.open("GET","funcionesPHP.php?q="+str,true);
                //Enviamos la solicitud
                asyncRequest.send(null);
                //Muestra los datos de la respuesta en la página
                function stateChange(){
                    //Si el estado de la conexión =4 solicitud inalizada
                    //Si la pagina tiene un status de 200 quiere decir que todo ok
                    if(asyncRequest.readyState==4 && asyncRequest.status == 200){
                        // id "sugerencias"
                        document.getElementById("sugerencias").innerHTML= asyncRequest.responseText;
                        //document.getElementById("libros").innerHTML= asyncRequest.responseText;
                    }
                }
            }
        }
    </script>
</head>
<body>
    <section>
        <h1>CONSULTA TITULOS LIBRO</h1>
        <hr>
        <form>
            <label> Titulo libros</label>
            <br>
            <br>
            <input type="text" onkeyup="mostrar_sugerencias(this.value)">
        </form>
        
        <p><strong>Sugerencias:</strong> <span id="sugerencias" style="color:#2792a5;"></span></p>
</body>
</html>