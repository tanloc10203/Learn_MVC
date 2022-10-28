<div id="overlay" style="display:none;">
  <div class="loader" style="width: 3rem; height: 3rem;"></div>
  <br />
  Loading...
</div>

<div id="toast"></div>

</div>

<!-- LIBRARY JS-->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php if (isset($params['js']) && is_array($params['js'])) : ?>
  <?php foreach ($params['js'] as $key => $value) : ?>
    <script src="<?= $this->getJs($value) ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

</body>

</html>