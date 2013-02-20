<nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="home.php?page=upload">Upload</a></li>
      <li><a href="home.php?page=edit">Edit</a></li>
      <li>Explore</li>
      <li><a href="#"><?php echo $current_user; ?></a></li>
      <li class="searchbar"><form id="searchform" method="get" action="search.php"><label for="search" id="searchlabel">Search</label>
    <input type="text" name="phrase" id="phrase" placeholder="Type Here" />
    <input type="submit" id="search" value="Search" />
    <input type="hidden" name="page" value="search" />
  </form></li>
    </ul>
  </nav>