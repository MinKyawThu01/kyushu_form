const call_frame = document.querySelector(".click_upload");
const vdo_upload = document.querySelector(".pr_vdo_uploader");
const close_vdo_tag = document.querySelector(".close");
const remove_dim_class = document.querySelector(".remove_dim_class");
const other_input = document.querySelectorAll(".others-input");
const nation_opt1 = document.querySelector("#nation_opt1");
const nation_opt2 = document.querySelector("#nation_opt2");
const policy_input = document.querySelector(".policy_input");
const submit_btn = document.querySelector(".submit_btn");
const never_input = document.querySelector("#never_input");
const visited_japan = document.querySelector(".visited_japan");
const c_form_radio = document.querySelectorAll(".c-form_radio");
const all_input = document.querySelectorAll(".all_input")

all_input.forEach((item) => {
    if (item.checked) {
        submit_btn.classList.add("show_pointer");
        remove_dim_class.classList.remove("dim");
        nation_opt2.disabled = false;
        nation_opt1.disabled = false;
        nation_opt1.classList.remove("dim");
        nation_opt2.classList.remove("dim");
        submit_btn.disabled = false;
    } else {
        submit_btn.classList.remove("show_pointer");
        remove_dim_class.classList.add("dim");
        nation_opt1.classList.add("dim");
        nation_opt2.classList.add("dim");
        nation_opt2.disabled = true;
        nation_opt1.disabled = true;
        // remove_dim_class.value = "";
    }
})

policy_input.addEventListener("click", () => {
    if (policy_input.checked) {
        submit_btn.disabled = false;
        submit_btn.classList.add("show_pointer")
    } else {
        submit_btn.disabled = true;
        submit_btn.classList.remove("show_pointer")
    }
})