
        <div class="Column middle">
            <h1 class="PageHeader">FitTines</h1>
            <h2 class="SectionHeader">My FitTines</h2>
            <form>
                <label for="RN">Routine Name</label>
                <br>
                <input type="text" placeholder=" ">
                <br><br>
                <label for="DC">Date Created</label><br>
                <input type="text" placeholder=" ">
                <br><br>
                <label for="pv">Private</label><br>
                
                <input type="text" placeholder=" "><br><br>
                <button type='submit'>New</button>
                <button type='submit'>View</button>
                <button type='submit'>Edit</button>
                <button type='submit'>Delete</button><br><br>
            <h2 class="SectionHeader">Saved FitTines</h2>
                <label for="RN">Routine Name</label>
                <br>
                <input type="text" placeholder=" ">
                <br><br>
                <label for="DC">Date Created</label><br>
                <input type="text" placeholder=" ">
                <br><br>
                <label for="pv">Created By</label><br>
                
                <input type="text" placeholder=" "><br><br>
                <button type='submit'>View</button>
                <button type='submit'>Delete</button>
            </form>
        </div>
        <div class="Column right">
            <?php
                include("../templates/rightNavBar.php");
            ?>
        </div>
    </div>
    <footer>
        <?php
            include("../templates/footer.php");
        ?>
    </footer>
</body>
</html>
