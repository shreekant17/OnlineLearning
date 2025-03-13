<link href="<?= base_url()?>assets/user/css/style2.css" rel="stylesheet" />
<div class="container d-flex justify-content-center" style="margin-top: 150px; min-height: 100vh;">
	<div class="window">
		<div class="order-info">
			<div class="order-info-content">
				<h3 class="d-flex justify-content-center m-4">Course details</h3>
				<div class="line"></div>
				<table class="order-table table" >
					<tbody>
						<tr>
							
							<td >
							<br>
								<h4 ><b><?= $course['course_name'] ?></b></h4>
								
								<div class="description" style="height: 30vh; overflow-y: scroll;">
									<?= $course['description'] ?><br />
								</div>
								
							</td>
						</tr>
						
					</tbody>
				</table>
				
				
				<br>
				<div class="total">
					<span style="float: left">
						<div class="thin dense">Price</div>
						TOTAL
					</span>
					<span style="float: right; text-align: right">
						<div class="thin dense">₹<?=$course['price']?></div>
						₹<?= $course['price']?>
					</span>
				</div>
			</div>
		</div>
		<div class="credit-info">
			<div class="credit-info-content">
				<h3 class="text-center text-white">Billing Information</h3>
				<br>
				<table class="table text-white" style="--bs-table-bg: transparent; --bs-table-color: white;" >
					<tr>
						<td>Name:</td>
						<td><?=$student['firstname'].' '.$student['lastname']?></td>
					</tr>
					<tr>
						<td>Mobile:</td>
						<td><?= $student['mobile_no']?></td>
					</tr>
					<tr>
						<td>E-Mail:</td>
						<td><?= $student['email']?></td>
					</tr>
					
				</table>
				<?php echo form_open(base_url('/payment/pay'),);  ?> 
				
					<input type="hidden" name="price" value="<?=$course['price']?>">
					<input type="hidden" name="course_id" value="<?=$course['course_id']?>">
					
					
					<input class="pay-btn text-center" type="submit" value="Pay Now"/>
				<?php echo form_close(); ?>
			</div>

		</div>
	</div>
</div>

<style>

   
	@import url(https://fonts.googleapis.com/css?family=Lato:400,300,700);
	/* Hide scrollbar for Chrome, Safari and Opera */
	*::-webkit-scrollbar {
	display: none;
	}

	/* Hide scrollbar for IE, Edge and Firefox */
	* {
	-ms-overflow-style: none;  /* IE and Edge */
	scrollbar-width: none;  /* Firefox */
	}
	body,
	html {
		height: 100%;
		margin: 0;
		
	}
	
	h2 {
		margin-bottom: 0px;
		margin-top: 25px;
		text-align: center;
		font-weight: 200;
		font-size: 19px;
		font-size: 1.2rem;
	}
	
	.dropdown-select.visible {
		display: block;
	}
	.dropdown {
		position: relative;
	}
	ul {
		margin: 0;
		padding: 0;
	}
	ul li {
		list-style: none;
		padding-left: 10px;
		cursor: pointer;
	}
	ul li:hover {
		background: rgba(255, 255, 255, 0.1);
	}
	.dropdown-select {
		position: absolute;
		background: #77aaee;
		text-align: left;
		box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.1);
		border-bottom-right-radius: 5px;
		border-bottom-left-radius: 5px;
		width: 90%;
		left: 2px;
		line-height: 2em;
		margin-top: 2px;
		box-sizing: border-box;
	}
	.thin {
		font-weight: 400;
	}
	.small {
		font-size: 12px;
		font-size: 0.8rem;
	}
	.half-input-table {
		border-collapse: collapse;
		width: 100%;
	}
	.half-input-table td:first-of-type {
		border-right: 10px solid #4488dd;
		width: 50%;
	}
	.window {
		height: 540px;
		width: 800px;
		background: #fff;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
		border-radius: 30px;
		z-index: 10;
	}
	.order-info {
		height: 100%;
		width: 50%;
		padding-left: 25px;
		padding-right: 25px;
		box-sizing: border-box;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		position: relative;
	}
	.price {
		bottom: 0px;
		position: absolute;
		right: 0px;
		color: #4488dd;
	}
	.order-table td:first-of-type {
		width: 25%;
	}
	.order-table {
		position: relative;
	}
	.line {
		height: 1px;
		width: 100%;
		margin-top: 10px;
		margin-bottom: 10px;
		background: #ddd;
	}
	.order-table td:last-of-type {
		vertical-align: top;
		padding-left: 25px;
	}
	.order-info-content {
		table-layout: fixed;
	}

	.full-width {
		width: 100%;
	}
	.pay-btn {
		border: none;
		background: #22b877;
		line-height: 2em;
		border-radius: 10px;
		font-size: 19px;
		font-size: 1.2rem;
		color: #fff;
		cursor: pointer;
		position: absolute;
		bottom: 25px;
		width: calc(100% - 50px);
		-webkit-transition: all 0.2s ease;
		transition: all 0.2s ease;
	}
	.pay-btn:hover {
		background: #22a877;
		color: #eee;
		-webkit-transition: all 0.2s ease;
		transition: all 0.2s ease;
	}

	.total {
		margin-top: 25px;
		font-size: 20px;
		font-size: 1.3rem;
		position: absolute;
		bottom: 30px;
		right: 27px;
		left: 35px;
	}
	.dense {
		line-height: 1.2em;
		font-size: 16px;
		font-size: 1rem;
	}
	.input-field {
		background: rgba(255, 255, 255, 0.1);
		margin-bottom: 10px;
		margin-top: 3px;
		line-height: 1.5em;
		font-size: 20px;
		font-size: 1.3rem;
		border: none;
		padding: 5px 10px 5px 10px;
		color: #fff;
		box-sizing: border-box;
		width: 100%;
		margin-left: auto;
		margin-right: auto;
	}
	.credit-info {
		background: blue;
		height: 100%;
		width: 50%;
		color: #eee;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		font-size: 14px;
		font-size: 0.9rem;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		box-sizing: border-box;
		padding-left: 25px;
		padding-right: 25px;
		border-top-right-radius: 30px;
		border-bottom-right-radius: 30px;
		position: relative;
	}
	.dropdown-btn {
		background: rgba(255, 255, 255, 0.1);
		width: 100%;
		border-radius: 5px;
		text-align: center;
		line-height: 1.5em;
		cursor: pointer;
		position: relative;
		-webkit-transition: background 0.2s ease;
		transition: background 0.2s ease;
	}
	.dropdown-btn:after {
		content: "\25BE";
		right: 8px;
		position: absolute;
	}
	.dropdown-btn:hover {
		background: rgba(255, 255, 255, 0.2);
		-webkit-transition: background 0.2s ease;
		transition: background 0.2s ease;
	}
	.dropdown-select {
		display: none;
	}
	.credit-card-image {
		display: block;
		max-height: 80px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 35px;
		margin-bottom: 15px;
	}
	.credit-info-content {
		margin-top: 25px;
		-webkit-flex-flow: column;
		-ms-flex-flow: column;
		flex-flow: column;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
	}
	@media (max-width: 600px) {
		.window {
			width: 100%;
			height: 100%;
			display: block;
			border-radius: 0px;
		}
		.order-info {
			width: 100%;
			height: auto;
			padding-bottom: 100px;
			border-radius: 0px;
		}
		.credit-info {
			width: 100%;
			height: auto;
			padding-bottom: 100px;
			border-radius: 0px;
		}
		.pay-btn {
			border-radius: 0px;
		}
	}
</style>

<script>
	var cardDrop = document.getElementById("card-dropdown");
	var activeDropdown;
	cardDrop.addEventListener("click", function () {
		var node;
		for (var i = 0; i < this.childNodes.length - 1; i++)
			node = this.childNodes[i];
		if (node.className === "dropdown-select") {
			node.classList.add("visible");
			activeDropdown = node;
		}
	});

	window.onclick = function (e) {
		console.log(e.target.tagName);
		console.log("dropdown");
		console.log(activeDropdown);
		if (e.target.tagName === "LI" && activeDropdown) {
			if (e.target.innerHTML === "Master Card") {
				document.getElementById("credit-card-image").src =
					"https://dl.dropboxusercontent.com/s/2vbqk5lcpi7hjoc/MasterCard_Logo.svg.png";
				activeDropdown.classList.remove("visible");
				activeDropdown = null;
				e.target.innerHTML = document.getElementById("current-card").innerHTML;
				document.getElementById("current-card").innerHTML = "Master Card";
			} else if (e.target.innerHTML === "American Express") {
				document.getElementById("credit-card-image").src =
					"https://dl.dropboxusercontent.com/s/f5hyn6u05ktql8d/amex-icon-6902.png";
				activeDropdown.classList.remove("visible");
				activeDropdown = null;
				e.target.innerHTML = document.getElementById("current-card").innerHTML;
				document.getElementById("current-card").innerHTML = "American Express";
			} else if (e.target.innerHTML === "Visa") {
				document.getElementById("credit-card-image").src =
					"https://dl.dropboxusercontent.com/s/ubamyu6mzov5c80/visa_logo%20%281%29.png";
				activeDropdown.classList.remove("visible");
				activeDropdown = null;
				e.target.innerHTML = document.getElementById("current-card").innerHTML;
				document.getElementById("current-card").innerHTML = "Visa";
			}
		} else if (e.target.className !== "dropdown-btn" && activeDropdown) {
			activeDropdown.classList.remove("visible");
			activeDropdown = null;
		}
	};
</script>
