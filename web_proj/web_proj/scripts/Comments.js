function openModal(imageSrc) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImage");
    var commentsTable = document.getElementById("commentsTable");

    // Concatenate "pictures/" with the image source
    modalImg.src = "pictures/" + imageSrc;

    commentsTable.innerHTML = `
            <tr>
                <th>User</th>
                <th>Comment</th>
            </tr>
            <tr>
                <td>User1</td>
                <td>This picture is amazing, I mean just look at that cute dog. Love it. Life just got more exciting and relaxing at the same time. Congrats for this beautiful picture.</td>
            </tr>
            <tr>
                <td>User2</td>
                <td>Comment2</td>
            </tr>
            <tr>
                <td>User3</td>
                <td>Comment3</td>
            </tr>
            <tr>
                <td>User4</td>
                <td>Comment4</td>
            </tr>
            <tr>
                <td>User5</td>
                <td>Comment5</td>
            </tr>
            <tr>
                <td>User6</td>
                <td>Comment6</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>MIVEL MEG NINCSEN HOZZAKOTVE ADATBAZIS, EZERT A HOZZAADOTT COMMENT MEG NEM MENTODIK EL SEHOL, EZERT HOGYHA KILEPUNK A COMMENT SZEKCIOBOL ES VISSZALEPUNK NEM LESZ OTT AZ UJ COMMENT.</td>
            </tr>
        `;

    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}


window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

function addComment() {
    var commentText = document.getElementById("commentText").value;
    if (commentText.trim() === "") {
        alert("Please enter a comment.");
        return;
    }

    var commentsTable = document.getElementById("commentsTable");
    var newRow = commentsTable.insertRow(-1);
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);
    cell1.textContent = "User";
    cell2.textContent = commentText;

    document.getElementById("commentForm").reset();

    commentsTable.scrollTop = commentsTable.scrollHeight;

    // Majd database-be kell menteni es elohuzni a dolgokat.
}