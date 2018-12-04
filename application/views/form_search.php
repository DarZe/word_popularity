<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('form');
$this->load->helper('url');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		
		<style type="text/css">
			.center_div {
		    margin: 0 auto;
		    width:80%;
			}
			.result_div h3 {
		    display: inline-block;
		    vertical-align: baseline;
		    line-height: 100%;
			}
		</style>
	</head>
	<body>
		<div class="container " style="margin-top: 20%;">
			<div class="row" >
				<div class = "col-sm-6 col-sm-offset-3">
					<form>
						<div class="form-group row">
							<div class= 'col-sm-9'>	
								<input name="searchTxt" type="text" placeholder="Search..." id="searchTxt" class="searchField form-control" required='true' />
								<small class="error" id="term-error"></small>
							</div>
							 <button type="button" class="btn  btn-success col-sm-3" id="sendText"><i class="glyphicon glyphicon-search" aria-hidden="true"></i> Search</button>
						</div>
						<div class="form-group row">
					        <label class="control-label col-sm-2 " for="name">Provider</label>
					        <div class = 'col-sm-5'>
						        <select name="provider" id="provider_id" class="form-control">
						            <?php foreach($provider as $api_call){
						                echo '<option value="'.$api_call->name.'">'.$api_call->name.'</option>';
						            } ?>
						        </select>
						        <small class="error" id="provider-error"></small>
					        </div>
				    	</div>		
					</form>
				</div>
			</div>
			<div class="row" >
				<div class = "col-sm-6 col-sm-offset-3">
					<div id="loading" hidden>
						<h3>Loading ...</h3>
					</div>
					<div id="result" class= "result_div  well "hidden>
						<h3>Term:</h3> <h3 id="term-value"></h3><br>
						<h3 id="term-result"></h3>
					</div>
				</div>
			</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	 
		<script type="text/javascript">
			$(document).ready(function() {   
			    $("#sendText").click(function() { 
			    	$('.error').hide();
			    	$('#result').hide();
			    	$('#searchTxt').closest('.form-group').removeClass('has-error');
			    	$('#loading').show();
			    	var main_url = "<?php echo site_url('Search_word/get_word')?>";
			    	var term = $("#searchTxt").val();
			    	var provider = $("#provider_id").val();
			    	
			     	jQuery.ajax({
			         	type: "GET",
			         	url: main_url + "?term=" + term + "&provider=" + provider,
			         	success: function(data) {
				 				var score = data['score'];
				            	var term = data['term'];
				            	var result = 'sucks';

				            	if (score >= 5) {
				            		result = 'rocks';
				            	}
				            	$('#loading').hide();
				            	$('#result').show();
				            	$('#term-value').html(term);
				            	$('#term-result').html(result);
			            },
			            error: function(response) {
			         		var message = response.responseJSON.message;
			         	
			         		$('#loading').hide();
			         		if (message['provider']) {
			         			$('#provider-error').html(message['provider']);
			         			$('#provider-error').show();
			         		}
			         		if (message['term']) {
			         			$('#searchTxt').closest('.form-group').addClass('has-error');
			         			$('#term-error').html(message['term']);
			         			$('#term-error').show();
			         		}
			            }
			        });
			     	return false;
				});
			});
		</script>
	</body>
</html>