function createMatchColumnsForName(header) {
    const optionsHTML = header.split(",").map((columnTitle, index) => `<option value="${index}">${columnTitle}</option>`)
    document.getElementById('match-cols-container').innerHTML = `
                <h1 class="h6">Match columns</h1>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="first-name">
                            <option selected>Select First Name</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="last-name">
                            <option selected>Select Last Name</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="email">
                            <option selected>Select Email</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="form-label col-sm-2 col-form-label">Phone number</label>
                    <div class="col-sm-10">
                        <select class="form-control form-select" id="phone-number">
                            <option selected>Select Phone number</option>
                            ${optionsHTML}
                        </select>
                    </div>
                </div>
        `
    document.getElementById("first-name").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnA").value = e.target.value
    }, false);
    document.getElementById("last-name").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnB").value = e.target.value
    }, false);
    document.getElementById("email").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnC").value = e.target.value
    }, false);
    document.getElementById("phone-number").addEventListener("change", function (e) {
        document.getElementById("csv_file_columnD").value = e.target.value
    }, false);
}

export function createEntitySelector(header) {
    document.getElementById("csv_file_entityType").addEventListener("change", function (e) {
        const entityType = e.target.value
        if (entityType == 1) {
            createMatchColumnsForName(header)
        } else {
            //
        }
    }, false);
}

