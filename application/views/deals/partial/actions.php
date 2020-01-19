<?php 
$is_favorite = $this->users_favorites->isFavorite($deal_id);
?>
<ul class="deal-actions top-15 <?php echo !isset($position) ? 'right-20' : $position; ?>">
    <li class="share-btn cursor-pointer">
        <div class="share-tooltip fade">
            <a target="_blank" href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $deal_link ?>', '_blank', 'width=500,height=300')"><i class="fa fa-facebook"></i></a>
            <a target="_blank" href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?php echo $deal_link ?>', '_blank', 'width=500,height=300')"><i class="fa fa-twitter"></i></a>
            <a target="_blank" href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo $deal_link ?>', '_blank', 'width=500,height=300')"><i class="fa fa-google-plus"></i></a>
        </div>
        <span><i class="fa fa-share-alt"></i></span>
    </li>
    <li class="like-deal cursor-pointer" <?php echo $is_favorite ? 'data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('favorite').'!"' : 'data-toggle="tooltip" data-placement="bottom" title="'.$this->lang->line('favorite').'?"'?>>
        <span href='#' class='addToFavorites <?php echo $is_favorite ? 'bg-white' : ''?>' deals_id='<?php echo $deal_id; ?>' type="photo">
            <i class="fa fa-heart <?php echo $is_favorite ? 'is-favorite' : ''?>"></i>
        </span>
    </li>
</ul>