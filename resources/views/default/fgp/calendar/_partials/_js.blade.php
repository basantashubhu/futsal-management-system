<script>
	
	$(function(){


		$(document).off('keydown', '.cal-list-search').on('keydown', '.cal-list-search', function(e){

			let sText = $(this).val();

			let searchTo = $(this).attr('data-search-to');

			let lists = $("ul[data-list-type = '"+searchTo+"'] li");

			if( sText.length >= 2 ){

				lists.each(function(i, list){

					if( $(list).text().trim().toLowerCase().includes(sText.toLowerCase() )){

						$(this).hasClass('hide-list') ? $(this).removeClass('hide-list') : $(this).addClass('show-list');

					}else{

						$(this).hasClass('show-list') ? $(this).removeClass('show-list') : $(this).addClass('hide-list');


					}

				});


			}else{

				lists.each(function(i, list){

					lists.hasClass('hide-list') ? $(this).removeClass('hide-list') : (lists.hasClass('show-list') ? lists.removeClass('show-list') : '');

				});

			}


		});





	});
	

</script>