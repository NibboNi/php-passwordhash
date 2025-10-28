export async function copyToClipboard(text) {
  const type = "text/plain";
  const clipboardItemData = {
    [type]: text,
  };

  const clipboardItem = new ClipboardItem(clipboardItemData);
  await navigator.clipboard.write([clipboardItem]);

  createToast(document.querySelector("#hashed"));
}

function createToast(parentContainer) {
  if (document.querySelector(".toast")) return;

  const toast = document.createElement("P");

  toast.classList.add("toast");
  toast.textContent = "Copied to clipboard!";

  parentContainer.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}
