function checkUploadButton() {
    const entityType = document.getElementById("csv_file_entityType").value
    let valid = true;

    if ( entityType === '1') {
        if (document.getElementById("first-name").value === "null") valid = false;
        if (document.getElementById("last-name").value === "null") valid = false;
        if (document.getElementById("email").value === "null") valid = false;
        if (document.getElementById("phone-number").value === "null") valid = false;
    } else {
        if (document.getElementById("file-name").value === "null") valid = false;
        if (document.getElementById("description").value === "null") valid = false;
    }
    document.getElementById('submit-btn').disabled = !valid;
}


            function createMatchColumnsForName(header) {
    const optionsHTML = header.split(",").map((columnTitle, index) => `<option value="${index}">${columnTitle}</option>`)
    document.getElementById('match-cols-container').innerHTML = `
                <h1 class="h6">Match columns</h1>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="first-name">
                            <option selected value="null">Select First Name</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="last-name">
                            <option selected value="null">Select Last Name</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="email">
                            <option selected value="null">Select Email</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Phone number</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="phone-number">
                            <option selected value="null">Select Phone number</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
        `
    document.getElementById("first-name").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnA").value = e.target.value
        checkUploadButton()
    }, false);
    document.getElementById("last-name").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnB").value = e.target.value
        checkUploadButton()
    }, false);
    document.getElementById("email").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnC").value = e.target.value
        checkUploadButton()
    }, false);
    document.getElementById("phone-number").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnD").value = e.target.value
        checkUploadButton()
    }, false);
}

function createMatchColumnsForCsv(header) {
    const optionsHTML = header.split(",").map((columnTitle, index) => `<option value="${index}">${columnTitle}</option>`)
    document.getElementById('match-cols-container').innerHTML = `
                <h1 class="h6">Match columns</h1>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">File name</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="file-name">
                            <option selected value="null">Select File name</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="description">
                            <option selected value="null">Select Description</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
        `
    document.getElementById("file-name").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnA").value = e.target.value
        checkUploadButton()
    }, false);
    document.getElementById("description").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnB").value = e.target.value
        checkUploadButton()
    }, false);
}


export function createEntitySelector(header) {
    document.getElementById("csv_file_entityType").addEventListener("change", function (e) {
        const entityType = e.target.value
        if (entityType == 1) {
            createMatchColumnsForName(header)
        } else {
            createMatchColumnsForCsv(header)
        }
    }, false);
}

