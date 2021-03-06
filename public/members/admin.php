<?php require_once('../../private/initialize.php'); ?>

<?php redirect_by_member_level(); ?>

<?php $member_set = find_all_members(); ?>

<?php $page_title = 'Members'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<main id="content">
  <h1>Members</h1>
  <a class="action" href="<?php echo url_for('/members/new_member.php'); ?>">Create New Member</a>

  <div class="member_table">
     <table class="list">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Member Level</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php while($member = mysqli_fetch_assoc($member_set)) { ?>
        <tr>
          <td><?php echo h($member['member_ID']); ?></td>
          <td><?php echo h($member['fname']); ?></td> 
          <td><?php echo h($member['lname']); ?></td> 
          <td><?php echo h($member['email']); ?></td>
          <td><?php echo h($member['phone']); ?></td>
          <td><?php echo h($member['member_level']); ?></td>


          <td><a class="action" href="<?php echo url_for('/members/show_member.php?id=' . h(u($member['member_ID']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/members/edit_member.php?id=' . h(u($member['member_ID']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/members/delete_member.php?id=' . h(u($member['member_ID']))); ?>">Delete</a></td>
          </tr>
      <?php } ?>
    </table>
  </div>
  <div class="push"></div>
</main>

<?php include(SHARED_PATH . '/footer.php'); ?>
