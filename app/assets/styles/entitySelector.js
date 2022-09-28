function createMatchColumnsForName(header) {
    const optionsHTML = header.split(",").map(columnTitle => `<option value="${columnTitle}">${columnTitle}</option>`)
    document.getElementById('match-cols-container').innerHTML = `
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
}

export function createEntitySelector(header) {
    document.getElementById('entity-container').innerHTML = `
                <div class="mb-3 row">
                    <label for="entity-select" class="form-label col-sm-2 col-form-label">Entity type</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="entity-select">
                            <option selected>Select the entity</option>
                            <option value="name">Name</option>
                            <option value="csv">CsvFile</option>
                        </select>
                    </div>
                </div>
        `
    document.getElementById("entity-select").addEventListener("change", function (e) {
        const entityType = e.target.value
        if (entityType === "name") {
            createMatchColumnsForName(header)
        }
    }, false);
}

