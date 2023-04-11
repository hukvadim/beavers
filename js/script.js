// To make the code look better, I make a function to check
const isUndefined = (el) => typeof el === 'undefined';
const isObject    = (el) => typeof el === 'object';
const isJSON      = (str) => { try { return (JSON.parse(str) && !!str); } catch (e) { return false; } };

// Do not allow clicking on a link if class is active
$('.js-active-self-link.active').click((e) => e.preventDefault());

// Tooltips for bootstrap
const tooltipList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

// Dropdown does not work without a call
// $('.dropdown-toggle').dropdown('toggle');

/**
 * Doesn't call the script multiple times
 */
let waitForFinalEvent = (function() {
	let timers = {};
	return function(callback, ms, uniqueId) {
		if (!uniqueId)
			uniqueId = "Не викликає двічі без унікального ідентифікатору";

		if (timers[uniqueId])
			clearTimeout(timers[uniqueId]);

		timers[uniqueId] = setTimeout(callback, ms);
	};
})();



/**
 * Textarea autogrow
 */
const textareaAutogrow = document.querySelector('textarea.autogrow');
if (textareaAutogrow) {
	textareaAutogrow.addEventListener('input', function() {
		this.style.height = (this.scrollHeight + 2) + 'px';
	});
}




/**
 * Php answer alert with js
 */
if (phpAnswer) {

	// Decode json
	phpAnswer = JSON.parse(phpAnswer);
	phpAnswer.value = (Array.isArray(phpAnswer.value)) ? phpAnswer.value.join('\n\r') : phpAnswer.value;

	// Display alerts for the user
	$.notify(phpAnswer.value, { className: phpAnswer.type, autoHideDelay: 7000 }); // notify type: success | info | warn | error
}



/**
 * Check for an image
 */
function imgAllow(size, type) {

	// We return this array in which we will collect errors
	const data = [];

	// Allowed types of images
	const imageTypes = ['image/jpeg', 'image/png'];

	// We check whether the size has been transferred. Also, whether it is not larger than allowed
	if (typeof size === 'number' && size >= option.maxSize)
		data.push('The image size is too large!');

	// Check if the type is passed and if it is not in the list of allowed types
	if (typeof type === 'string' && !imageTypes.includes(type))
		data.push('Picture type is not allowed! Allowed only .jpg, .png');

	// We return the result
	return data;
}


/**
 * Clean up the preview image
 */
function cleanAvatar(argument) {
	// Delete an activity class
	$('#set-avatar').removeClass('has-preview');

	// Clear the path in the picture
	document.getElementById('img-preview').src = '';
}



/**
 * Simple preview image
 */
function loadAvatar(event) {
	const setAvatar            = $('#set-avatar'); // The block in which we will display the preview of the image
	const output               = document.getElementById('img-preview'); // The visual part of the picture
	const outputName           = document.getElementById('img-preview-name'); // The visual part of the picture
	const [file]               = event.target.files; // In order to avoid accessing the null array, we destructure it into a variable 
	const { name, size, type } = file; // We also destructure the values of the file array
	const error                = imgAllow(size, type); // Check the image 

	// If there are no errors, we display the image
	if (!error.length) {

		// Insert a picture into html
		output?.setAttribute('src', URL.createObjectURL(file));

		// If there is space for a name, we also display the name
		outputName !== null ? outputName.innerHTML = name : null;

		// Display alerts for the user
		$.notify('Good picture! =)', 'success');

	// If errors are found, we display them
	} else {

		// Display alerts for the user
		$.notify(error.join('\n\r'), { className: 'error', autoHideDelay: 12000 });

		// Clean image preview
		cleanAvatar();
	}

	// Additionally, we label the avatar that the button contains a picture
	setAvatar.toggleClass('has-preview', !error.length);
}


/**
 * Output html result is not available
 */
const viewNoResult = () => {
	return `<div class="no-result text-center">
				<img src="${option.path}img/no-result.png" alt="No results" class="no-result__img">
				<h3 class="no-result__title">No results found</h3>
			</div>`;
}



/**
 * The function that will be responsible for displaying the article card
 */
const viewCardArticle = ( {link, title, img, cat_link, cat_name, text_sm, user_link, user_avatar, user_full_name} ) => {
	return `<div class="card card-article hover-scale-el">
				<div class="card-img-hold scale-el">
					<a href="${link}" class="card-img-link d-flex">
						<img src="${img}" alt="${title}" class="card-img">
					</a>
				</div>
				<div class="card-body">
					<a href="${cat_link}" class="btn btn-category btn-primary btn-sm">${cat_name}</a>
					<a href="${link}" class="card-title btn-link">${title}</a>
					<p class="card-text">${text_sm}</p>
					<a href="${user_link}" class="btn btn-user btn-user--sm rounded-5 d-flex-center">
						<img src="${user_avatar}" alt="${user_full_name}" width="30" height="30" class="user-img rounded-circle">
						<span class="user-name icon-m-left-lg">${user_full_name}</span>
					</a>
				</div>
			</div>`;
}



/**
 * The function that will be responsible for displaying the comment card
 */
const viewCardComment = ( {user_link, user_img, user_name, comment_date, comment} ) => {
	return `<div class="item-comment">
				<div class="item-comment__header">
					<a href="${user_link}" class="btn btn-user btn-user--offset btn-user--sm rounded-5 justify-content-start align-items-center">
						<img src="${user_img}" alt="${user_name}" width="30" height="30" class="user-img rounded-circle">
						<span class="user-name icon-m-left-lg">${user_name}</span>
						<span class="user-date icon-m-left-lg">${comment_date}</span>
					</a>
				</div>
				<p class="item-comment__text">${comment}</p>
			</div>`;
}



/**
 * On the search page, we will asynchronously search the database for results
 */
function tochSearch(searchValue = '')
{
	// Generating data for ajax
	const data = {
		'form-type': 'search',
		'query': searchValue
	}

	// Calling a query
	setAjax(data, false, viewSearchResult);
}



/**
 * We display articles when searching
 */
function viewSearchResult(result)
{
	// Get list element
	const list = $('.js-list-articles');

	// Parse json
	result = JSON.parse(result);

	// If there is a result, display the article cards
	if (result.length === 0) {

		// Otherwise, we show an error
		list.html( viewNoResult() );
	} else {

		// Clean html before add articles
		list.empty();

		// View articles
		$.each(result, function(index, article) {

			// Add articles to list
			const listItem = $( viewCardArticle(article) ).hide();
			list.append(listItem);
			listItem.delay(index * 100).fadeIn();
		});
	} 
}





/**
 * When searching, we take you to the search page with the search phrase
 */
$('.js-nav-form-search').submit(function(event) {
	event.preventDefault();

	// Select the search phrase from the search field
	const searchVal = $(this).find('input.form-control').val();

	// If there is a search phrase, then we take you to the search page
	if (searchVal.length === 0)
		window.location.href = option.searchPage;
	else
		window.location.href = option.searchPage + '&query=' + searchVal;
});




/**
 * We make it easy to find what you're looking for in the search form on the search page
 */
$('.js-set-query-onkeup').on('keyup change search', function(e)
{
	// Save the value that the user enters in the search field
	let searchVal = $(this).val();

	// We check if there is a value and then at least output something
	if (searchVal.length == 0)
		searchVal = '...';

	// Visually show what we are going to look for somewhere else
	$('.js-query-onkeup').html(searchVal);

	// We call the function only once per second. Waiting for the user to type at least something
	waitForFinalEvent(() => {
		tochSearch(searchVal);
	}, 1200)
})



/**
 * A general AJAX function for sending POST requests
 */
function setAjax(data = {}, form = false, successCallback = null, dataType = 'text')
{
	if (dataType !== 'json' && dataType !== 'text')
		throw new Error(`Invalid data type '${dataType}'`);

	// Declare variables here to avoid getting "is not defined"
	let button, loading;
	let addForAjax = {};

	// If the form is passed then there will be undefined
	if (isUndefined(form)) throw new Error('Form element not passed');

	// If the form is passed, then we form additional variables
	if (isObject(form)) {
		form = $(form); // Make the form a jquery object
		button = form.find('[type="submit"]'); // Submit button 
		loading = 'loading'; // Css class download effect

		// Without these settings, it generates an error and does not send information.
		addForAjax = {
			processData: false,
			contentType: false,
		}
	}

	return $.ajax({
		type: 'POST',
		url: option.path + 'ajax.php',
		dataType: dataType,
		data: data,
		cache: false,
		...addForAjax,
		beforeSend: function() {

			// If a form is submitted, then make the button disabled
			if (isObject(button)) button.attr('disabled', 'disabled').addClass(loading);
		},
		success: function(response) {

			console.log("response", response);

			// We check if the json has really come to us.
			if (!isJSON(response)) return $.notify('Ajax cannot accept a response from the controller');

			// Generate settings from the answer
			let {value, type, link, callFunc, callFuncData} = JSON.parse(response);

			// Display alerts for the user
			if (value) $.notify(value, { className: type, autoHideDelay: 12000 });

			// If you need something more, we can additionally create a function
			if (callFunc) window[callFunc](callFuncData, response);

			// If you need something more, we can additionally create a function
			if (successCallback) successCallback(response);

			// Link to the link, if available
			if (link) setTimeout(() => { window.location.href = link }, 1500);

		},
		complete: function(data) {

			// If a form is submitted, then remove button disabled
			if (isObject(button)) setTimeout(() => { button.removeAttr('disabled').removeClass(loading); }, 1500);
		}
	});
}




/**
 * Sending a form via Ajax
 */
$(document).on('submit', 'form.js-send-form', function(e) {
	e.preventDefault();

	// Automatically collects all the data from the form inputs
	const formData = new FormData(this);

	// Sending data to ajax
	setAjax(formData, this);
});




/**
 * View comment after add
 */
function viewNewComment(commentData, response)
{
	// View comment in list
	const commentItem = $( viewCardComment(commentData['comment']) ).hide();
	$('.js-comments-list').prepend(commentItem);
	commentItem.delay(100).fadeIn();

	// Close comment
	$('#js-show-comment-form').slideUp('fast');

	// Clear text from the comment field
	$('.js-comments-summ').html(commentData['commentSum']);

	// Clear text from the comment field
	$('.js-comment-input').val('');

	// Remove no result block
	const notResult = $('.js-comments-list .no-result');

	// If exist delete
	if (notResult.length) notResult.fadeOut('fast', () => notResult.remove() );
}



/**
 * After updating the profile, update its data in html
 */
function viewNewUserInfo(userData, response) {

	console.log("userData", userData);
}