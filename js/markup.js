/*
 *  markup.js
 *
 *  Copyright (c) 2012 - Adam Hovorka - No Rights Reserved
 *
 *  This work is in the public domain.
 *  Do with it as you please, and
 *  distribute it like crazy.
 */

/*
 *  Use:
 *
 *    Call with $( selector ).markup();
 *
 *    Processes inner HTML and *bolds* and _italicizes_ text like that,
 *    and makes [these](http://example.com) into links.
 *
 *    The syntax was inspired by Google Chat and Markdown.
 *
 *
 *  Dependencies:
 *
 *    jQuery 1.7.1 or higher
 */

(function($) {

	$.fn.markup = function() {
		return this.each(function(){

			// Get the HTML content to process
			var input = $(this).html();
			if (input.charAt(input.length - 1) == "\n") {
				input = input.slice(0,-1); }

			// Split HTML into an array of words
			input = input.split(" ");

			// Iterate over the array
			for (i in input) {

				// *_Bold and Italic_*
				if (input[i].slice(0, 2) == "*_") {
					input[i] = "<strong><em>" + input[i].slice(2); }
				if (input[i].slice(-2) == "_*") {
					input[i] = input[i].slice(0, -2) + "</em></strong>"; }

				// _*Italic and Bold*_
				if (input[i].slice(0, 2) == "_*") {
					input[i] = "<em><strong>" + input[i].slice(2); }
				if (input[i].slice(-2) == "*_") {
					input[i] = input[i].slice(0, -2) + "</strong></em>"; }

				// *Bold*
				if (input[i].charAt(0) == "*") {
					input[i] = "<strong>" + input[i].slice(1); }
				if (input[i].charAt(input[i].length-1) == "*") {
					input[i] = input[i].slice(0, -1) + "</strong>"; }

				// _Italic_
				if (input[i].charAt(0) == "_") {
					input[i] = "<em>" + input[i].slice(1); }
				if (input[i].charAt(input[i].length-1) == "_") {
					input[i] = input[i].slice(0, -1) + "</em>"; }

				// [links](http//example.com)
				if (input[i].charAt(0) == "[") {
					for (j=i; j<input.length; j++) {
						if (input[j].indexOf("](") != -1) {
							var x = input[j].charAt(input[j].length - 1); var y = false;
							// You may wish to expand this list with your own punctuation.
							if ([".", ",", "!", "?", ":", ";"].indexOf(x) != -1) {
								var url = input[j].slice(input[j].indexOf("](") + 2).slice(0,-2); y = true;
							} else {
								var url = input[j].slice(input[j].indexOf("](") + 2).slice(0,-1); }
							input[i] = "<a href='" + url + "'>" + input[i].slice(1);
							input[j] = input[j].slice(0, input[j].indexOf("](")) + "</a>";
							if (y) {input[j] = input[j] + x}
							break;
			}	}	}	}

			// Piece the content back together
			var output = "";
			for (i in input) {
			output = output + input[i] + " "; }
			output = output.slice(0, -1);

			// Put the output back in
			$(this).html(output);
		});
	};
})(jQuery);
