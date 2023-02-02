<nav id = "navbar2">
    
    <div class=" d-flex justify-content-end">
        <a class="identifiant">
            <?php print_r( $_SESSION['nom']);?>
        </a>
        <?php
        if($_SESSION['admin']==TRUE){ ?>
            <a class='boutonNav' href='gestuser.php'>
                <button type='button' class='btn btn-primary'>
                    Utilisateur
                </button>
            </a><?php
            }
        ?>
        <?php
        if($_SESSION['admin']==TRUE){ ?>
            <a class='boutonNav' href='gestionbien.php'>
                <button type='button' class='btn btn-primary'>
                    Annonce
                </button>
            </a><?php
            }
        ?>
        <a class='boutonNav' href='deconnexion.php'>
            <button type='button' class='btn btn-primary'>
                Deconnexion
            </button>
        </a>
    </div>
</nav>