<style>
    body {
  background-image: linear-gradient(135deg, #14C38E 10%, #E3FCBF 100%);
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  font-family: "Open Sans", sans-serif;
  color: #333333;
}

.box-form {
  margin: 0 auto;
  width: 80%;
  background: #FFFFFF;
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex: 1 1 100%;
  align-items: stretch;
  justify-content: space-between;
  box-shadow: 0 0 20px 6px #090b6f85;
}
@media (max-width: 980px) {
  .box-form {
    flex-flow: wrap;
    text-align: center;
    align-content: center;
    align-items: center;
  }
}
.box-form div {
  height: auto;
}
.box-form .left {
  color: #FFFFFF;
  background-size: cover;
  background-repeat: no-repeat;
  background-image: url("https://images.pexels.com/photos/96715/pexels-photo-96715.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2");
  overflow: hidden;
}
.box-form .left .overlay {
  padding: 30px;
  width: 100%;
  height: 100%;
  background: #14C38E80;
  overflow: hidden;
  box-sizing: border-box;
}
.box-form .left .overlay h1 {
  font-size: 10vmax;
  line-height: 1;
  font-weight: 900;
  margin-top: 40px;
  margin-bottom: 20px;
}
.box-form .left .overlay span p {
  margin-top: 30px;
  font-weight: 900;
}
.box-form .left .overlay span a {
  background: #3b5998;
  color: #FFFFFF;
  margin-top: 10px;
  padding: 14px 50px;
  border-radius: 100px;
  display: inline-block;
  box-shadow: 0 3px 6px 1px #042d4657;
}
.box-form .left .overlay span a:last-child {
  background: #1dcaff;
  margin-left: 30px;
}
.box-form .right {
  padding: 40px;
  overflow: hidden;
}
@media (max-width: 980px) {
  .box-form .right {
    width: 100%;
  }
}
.box-form .right h5 {
  font-size: 6vmax;
  line-height: 0;
}
.box-form .right p {
  font-size: 14px;
  color: #B0B3B9;
}
.box-form .right .inputs {
  overflow: hidden;
}
.box-form .right input {
  width: 100%;
  padding: 10px;
  margin-top: 25px;
  font-size: 16px;
  border: none;
  outline: none;
  border-bottom: 2px solid #B0B3B9;
}
.box-form .right .remember-me--forget-password {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.box-form .right .remember-me--forget-password input {
  margin: 0;
  margin-right: 7px;
  width: auto;
}
.box-form .right button {
  float: right;
  color: #fff;
  font-size: 16px;
  padding: 12px 35px;
  border-radius: 50px;
  display: inline-block;
  border: 0;
  outline: 0;
  box-shadow: 0px 4px 20px 0px #49c628a6;
  background-image: linear-gradient(135deg, #70F570 10%, #49C628 100%);
}

label {
  display: block;
  position: relative;
  margin-left: 30px;
}

label::before {
  content: ' \f00c';
  position: absolute;
  font-family: FontAwesome;
  background: transparent;
  border: 3px solid #70F570;
  border-radius: 4px;
  color: transparent;
  left: -30px;
  transition: all 0.2s linear;
}

label:hover::before {
  font-family: FontAwesome;
  content: ' \f00c';
  color: #fff;
  cursor: pointer;
  background: #70F570;
}

label:hover::before .text-checkbox {
  background: #70F570;
}

label span.text-checkbox {
  display: inline-block;
  height: auto;
  position: relative;
  cursor: pointer;
  transition: all 0.2s linear;
}

label input[type="checkbox"] {
  display: none;
}
</style>
<br><br>
<link rel="icon" href="img/AGRO-LOGO.png">
<!-- partial:index.partial.html -->
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<h1>Hola.</h1>
		<p>Bienvenido al sitio de compra y venta de cosechas agricolas</p>
		<span>
			<p>Inicia secion con Facebook o Twitter</p>
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Login with Twitter</a>
		</span>
		</div>
	</div>
	
	
		<div class="right">
		<h5>Ingresar</h5>
		<p>No tienes cuenta aun? <a href="crear-cuenta.php">Crea la tuya</a> Solo tomara unos minutos</p>
		<form action="validar.php" method="post"> 
        <div class="inputs">
			<input type="text" placeholder="Nombre de usuario" required name="name">
			<br>
			<input type="password" placeholder="Contraseña" required name="pass">
		</div>
			
			<br><br>
			
		<div class="remember-me--forget-password">
				<!-- Angular -->
	
			<p>forget password?</p>
		</div>
			
			<br>
			<button type="submit" name="ingresar" >Iniciar Sesion</button>
	</div>
    </form>
	
</div>