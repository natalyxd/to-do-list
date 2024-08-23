// Function to populate the form for editing a task
function editTask(id, title, description, due_date) {
    document.getElementById('task_id').value = id;
    document.getElementById('title').value = title;
    document.getElementById('description').value = description;
    document.getElementById('due_date').value = due_date;
    document.getElementById('formAction').value = 'update';
    document.getElementById('submitButton').textContent = 'Update Task';
}
