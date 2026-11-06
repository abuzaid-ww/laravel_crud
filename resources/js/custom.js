// // Attach it to window so HTML onclick can see it
// window.deletePost = async function(postId) {
//     if (!confirm("Are you sure you want to delete this post?")) {
//         return;
//     }

//     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//     try {
//         let response = await fetch(`/delete-post/${postId}`, {
//             method: 'DELETE',
//             headers: {
//                 'X-CSRF-TOKEN': csrfToken,
//                 'Content-Type': 'application/json',
//                 'Accept': 'application/json'
//             }
//         });

//         if (response.ok) {
//             const postElement = document.getElementById(`post-container-${postId}`);
//             if (postElement) {
//                 postElement.remove();
//             }
//         } else {
//             alert('Something went wrong while deleting the post.');
//         }
//     } catch (error) {
//         console.error('Error:', error);
//         alert('Network error occurred.');
//     }
// }

window.deletePost = async function (postId) {
    if (!confirm("Are you sure you want to delete this post?")) {
        return;
    }

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    try {
        let response = await fetch(`/delete-post/${postId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });

        if (response.ok) {
            // 1. Remove the post element smoothly from the DOM
            const postElement = document.getElementById(
                `post-container-${postId}`,
            );
            if (postElement) {
                postElement.remove();
            }

            // 2. Trigger the Toast Notification!
            Toastify({
                text: "Post deleted successfully!",
                duration: 3000, // 3 seconds
                gravity: "top", // Position at top
                position: "right", // Position on the right side
                backgroundColor: "#198754", // Bootstrap success green
                stopOnFocus: true, // Stops timer if mouse hovers over it
            }).showToast();
        } else {
            let errorText = await response.text();
            console.error("Server Error:", errorText);

            // Error Toast
            Toastify({
                text: "Failed to delete post.",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#dc3545", // Bootstrap danger red
            }).showToast();
        }
    } catch (error) {
        console.error("Network Error:", error);
    }
};
