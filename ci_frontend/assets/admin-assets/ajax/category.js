$(document).ready(function () {
	const addModal = $("#categoryModal");
	const editModal = $("#editModal");

	$("#addForm").submit(function (e) {
		e.preventDefault();

		let formData = $(this).serialize();
		$.ajax({
			url: "add-category",
			method: "post",
			data: formData,
			dataType: "json",

			success: function (resp) {
				console.log(resp);
				formModalClose(addModal, $("#addForm"));
				if (resp.message == "success") {
					message("New Category Added Successfully!", "success");
				}
			},

			error: function (xhr, status, error) {
				res(xhr.responseText);
			},
		});
	});

	$(document).on("click", "#edit-btn", function (e) {
		e.preventDefault();

		resetForm($("#updateForm"));

		let id = $(this).attr("data-id");

		$.ajax({
			url: "edit-category",
			method: "get",
			data: { id: id },
			dataType: "json",

			success: function (data) {
				console.log(data);
				$("#category-id").val(data.category_id);
				$("#category-name").val(data.name);

				editModal.modal("show");
			},

			error: function (xhr, status, error) {
				res(xhr.responseText);
			},
		});
	});

	$("#updateForm").submit(function (e) {
		e.preventDefault();

		let formData = $(this).serialize();

		$.ajax({
			url: "update-category",
			method: "post",
			data: formData,
			dataType: "json",

			success: function (resp) {
				res(resp);
				formModalClose(editModal, $("#updateForm"));
				if (resp.message == "success") {
					message("Category Updated Successfull!", "success");
				}
			},

			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	});
});
