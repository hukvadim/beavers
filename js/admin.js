/**
 * Request when deleting a deletion
 */
$(document).on('click', '.js-delete', function() { if (!confirm('Are you sure you want to delete this item?')) return false; });



/**
 * The function that will be responsible for displaying the admin card
 */
const viewCardAdmin = ( {urlEdit, urlDel, cardImg, cardTitle, cardText} ) => {
	return  `<div class="admin-card hover-scale-el">
				${ cardImg ? `<a href="${urlEdit}" class="admin-card__img-hold scale-el"><img src="${cardImg}" alt="" class="admin-card__img"></a>` : ''}
				<div class="admin-card__text-hold">
					<a href="${urlEdit}" class="admin-card__title text-truncate">${cardTitle}</a>
					${ cardText ? `<p class="admin-card__desk text-truncate-2cols">${cardText}</p>` : '' }
					<div class="admin-card__btn-list">
						<a href="${urlEdit}" class="admin-card__btn btn btn-link btn-admin btn-sm btn-edit">
							<svg class="icon icon-edit"><use xlink:href="#icon-edit"></use></svg>
							Редагувати
						</a>
						<a href="${urlDel}" class="admin-card__btn btn btn-link btn-admin btn-sm btn-delete js-delete">
							<svg class="icon icon-delete"><use xlink:href="#icon-delete"></use></svg>
							Видалити
						</a>
					</div>
				</div>
			</div>`;
}




/**
 * We make it easy to find what you're looking for in the search form on the search page
 */
$('.js-admin-search-onkeup').on('keyup change search', function(e)
{
	// Save the value that the user enters in the search field
	const input = $(this);
	const searchVal = input.val();
	const pageType = input.data('page-type');

	// We call the function only once per second. Waiting for the user to type at least something
	waitForFinalEvent(() => {
		tochAdminSearch(searchVal, pageType);
	}, 1200)
})



/**
 * On the search page, we will asynchronously search the database for results
 */
function tochAdminSearch(searchValue = '', pageType = 'users')
{
	// Generating data for ajax
	const data = {
		'admin'    : 'true',
		'form-type': 'search',
		'pageType' : pageType,
		'query'    : searchValue
	}

	// Calling a query
	setAjax(data, false, viewAdminSearchResult);
}



/**
 * We display articles when searching
 */
function viewAdminSearchResult(result)
{
	// Parse json
	result = JSON.parse(result);
	console.log("result", result);
	
	// Base box list
	const boxList = $('.js-box-card-list');

	// Get list element
	const list = $('.js-box-search-card-list');

	// If there is a result, display the article cards
	if (result.length === 0) {

		// Hide base view html
		boxList.slideDown('fast');

		// Hide base view html
		list.slideUp('fast');

	} else {

		// Hide base view html
		boxList.slideUp('fast');

		// Hide base view html
		list.slideDown('fast');

		// Clean html before add articles
		list.empty();

		// View articles
		$.each(result, function(index, searchData) {

			// Add articles to list
			const listItem = $( viewCardAdmin(searchData) ).hide();
			list.append(listItem);
			listItem.delay(index * 100).fadeIn();
		});
	} 
}