"use strict";
let likeComment = async (id) => {
    document
      .querySelector(`#likes_btn_comment_${id}`)
      .setAttribute("disabled", "disabled");
    try {
      let req = await fetch(`${apiUrl}/likeComment.php?id=${id}`);
      if (!req.ok) throw "Request not found";
      console.log(req);
      await req;
      let oldCount = Number(document.querySelector(`#likes_count_comment_${id}`).innerHTML);
      document.querySelector(`#likes_count_comment_${id}`).innerHTML = oldCount + 1;
      document.querySelector(`#likes_btn_comment_${id}`).style.display = "none";
      document.querySelector(`#unlikes_btn_comment_${id}`).style.display = "block";
    } catch (ex) {
      console.log(ex);
    } finally {
      document.querySelector(`#likes_btn_comment_${id}`).removeAttribute("disabled");
    }
  };
  
  let unLikeComment = async (id) => {
    document
      .querySelector(`#unlikes_btn_comment_${id}`)
      .setAttribute("disabled", "disabled");
    try {
      let req = await fetch(`${apiUrl}/unlikeComment.php?id=${id}`);
      if (!req.ok) throw "Request not found";
      console.log(req);
      await req;
      let oldCount = +document.querySelector(`#likes_count_comment_${id}`).innerHTML;
      if (oldCount <= 1) oldCount = 1;
      document.querySelector(`#likes_count_comment_${id}`).innerHTML = oldCount - 1;
      document.querySelector(`#likes_btn_comment_${id}`).style.display = "block";
      document.querySelector(`#unlikes_btn_comment_${id}`).style.display = "none";
    } catch (ex) {
      console.log(ex);
    } finally {
      document.querySelector(`#unlikes_btn_comment_${id}`).removeAttribute("disabled");
    }
  };
  let followUser = async (id) => {
    document
      .querySelector(`#follow_btn_${id}`)
      .setAttribute("disabled", "disabled");
    try {
      let req = await fetch(`${apiUrl}/follow.php?id=${id}`);
      if (!req.ok) throw "Request not found";
      console.log(req);
      await req;
      document.querySelector(`#follow_btn_${id}`).style.display = "none";
      document.querySelector(`#unfollow_btn_${id}`).style.display = "block";
    } catch (ex) {
      console.log(ex);
    } finally {
      document.querySelector(`#follow_btn_${id}`).removeAttribute("disabled");
    }
  };
  
  let unfollowUser = async (id) => {
    document
      .querySelector(`#unfollow_btn_${id}`)
      .setAttribute("disabled", "disabled");
    try {
      let req = await fetch(`${apiUrl}/unfollow.php?id=${id}`);
      if (!req.ok) throw "Request not found";
      console.log(req);
      await req;
      document.querySelector(`#follow_btn_${id}`).style.display = "block";
      document.querySelector(`#unfollow_btn_${id}`).style.display = "none";
    } catch (ex) {
      console.log(ex);
    } finally {
      document.querySelector(`#unfollow_btn_${id}`).removeAttribute("disabled");
    }
  };
