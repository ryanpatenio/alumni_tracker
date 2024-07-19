$(document).ready(function () {
	const addModal = $("#productModal");
	const editModal = $("#editModal");

	$("#addForm").submit(function (e) {
		e.preventDefault();

		let formData = $(this).serialize(); //Serialize array
		$url = baseUrl + "ProductController/insert";
		//ajax
		$.ajax({
			url: $url,
			method: "post",
			data: formData,
			dataType: "json",

			success: function (resp) {
				//res(resp);
				formModalClose(addModal, $("#addForm"));

				if (resp.code == 0) {
					// Get the number in the last row and convert it to an integer
					var num = parseInt($("#dataTable tr:last td:first").text());
					num++; // Add 1 to the number

					message("New Product Added Successfully!", "success");

					$row = '<tr class="row' + resp.data[0].id + '">';
					$row += "<td>" + num + "</td>";
					$row +=
						'<td class="product_name' +
						resp.data[0].id +
						'">' +
						resp.data[0].product_name +
						"</td>";

					$row += "<td>";

					$row +=
						'    <button type="button" data-id="' +
						resp.data[0].id +
						'" class="btn btn-warning bi bi-pencil" id="edit-btn"> Modify</button>';
					$row +=
						'<button type="button" data-id"' +
						resp.data[0].id +
						'" class="btn btn-danger bi bi-trash"> Delete</button>';

					$row += "</td>";

					$row += "</tr>";
					$("#dataTable").append($row);

					// Update the text content of the last row with the new number
					$("#dataTable tr:last td:first").text(num);
				} else {
					msg(resp.message, "error");
				}
			},
			error: function (xhr, status, error) {
				console.log(xhr.responseText);
				// if (xhr.responseJSON.message == "validation_false") {
				// 	msg("Oops! Unexpected Error! Validation Error", "error");
				// }
			},
		});
	});

	//edit Modal
	$(document).on("click", "#edit-btn", function (e) {
		e.preventDefault();

		//reset form first
		resetForm($("#updateForm"));

		//get the ID of Product using attributes in btn data-id
		let id = $(this).attr("data-id");
		$url = baseUrl + "ProductController/edit";

		$.ajax({
			url: $url,
			method: "get",
			data: { id: id }, //first param the variable will you catch in the controller 2nd param the let id variable
			dataType: "json",

			success: function (res) {
				//expects json data to return
				//console.log(res);
				editModal.modal("show");
				$("#product-id").val(res.data[0].id);
				$("#product-name").val(res.data[0].product_name);
				//$("#current-category").val(data[0].category_id);
				//$("#current-category").text(data.category_name);
			},

			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	});

	//submit update Form
	$("#updateForm").submit(function (e) {
		e.preventDefault();

		let formData = $(this).serialize();

		$url = baseUrl + "ProductController/update";

		$.ajax({
			url: $url,
			method: "post",
			data: formData,
			dataType: "json",

			success: function (resp) {
				//console.log(resp);
				formModalClose(editModal, $("#updateForm"));
				if (resp.code !== 0) {
					message(res.message, "error");
					return;
				}
				message("Product Updated Successfully!", "success");
			},

			error: function (xhr, status, error) {
				res(xhr.responseText);
				// if (xhr.responseJSON.message == "id_null") {
				// 	msg("Oops! ID null", "error");
				// }
				// if (xhr.status == 500) {
				// 	msg("Oops! unexpected Error!", "error");
				// }
			},
		});
	});

	$(document).on("click", "#delete-btn", function (e) {
		e.preventDefault();

		let id = $(this).attr("data-id");
		$url = baseUrl + "ProductController/delete";

		$.ajax({
			url: $url,
			method: "post",
			data: { id: id },
			dataType: "json",

			success: function (resp) {
				res(resp);
				if (resp.code !== 0) {
					msg(resp.message, "error");
					return;
				}

				message("Product Deleted Successfully!", "success");
			},
			error: function (xhr, status, error) {
				res(xhr.responseText);
			},
		});
	});
});
