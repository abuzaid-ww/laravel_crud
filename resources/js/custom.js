window.deletePost = async function (postId) {
    if (!confirm("Are you sure you want to delete this post?")) {
        return;
    }

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    try {
        const response = await fetch(`/delete-post/${postId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
                Accept: "application/json",
            },
        });

        const data = await response.json();

        if (response.ok) {
            // 1. Remove from DOM
            document.getElementById(`post-container-${postId}`)?.remove();

            // 2. Success Toast
            Toastify({
                text: data.message || "Post deleted successfully!",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#198754",
                stopOnFocus: true,
            }).showToast();
        } else {
            // Server error toast (403, 404, 500)
            Toastify({
                text: data.message || "Failed to delete post.",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#dc3545",
                stopOnFocus: true,
            }).showToast();
        }
    } catch (error) {
        console.error("Network Error:", error);
        Toastify({
            text: "Network error. Please try again.",
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#dc3545",
            stopOnFocus: true,
        }).showToast();
    }
};
