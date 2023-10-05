const callIframTag = document.getElementsByClassName("click_upload")[0];
const iFrameTag = document.querySelector(".pr_vdo_uploader");
const closeTag = document.querySelector(".close");
const selectedTag = document.querySelector(".selected");
const removeDimClassTag = document.querySelector(".remove_dim");
console.log(removeDimClassTag)
callIframTag.addEventListener("click", () => {
    iFrameTag.style.display = "block"
})

closeTag.addEventListener("click", () => {
    iFrameTag.style.display = "none"
})

selectedTag.addEventListener("click", () => {
    const hasDim = removeDimClassTag.classList.contains("selectedDim");
    if (hasDim) {
        removeDimClassTag.classList.add("dim");
        removeDimClassTag.classList.remove("selectedDim")
    } else {
        removeDimClassTag.classList.remove("dim")
        removeDimClassTag.classList.add("selectedDim")
    }
})