<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SupportCommentRequest;
use App\Models\Support;
use App\Models\SupportComment;
use App\Repo\SupportCommentRepo;
use Illuminate\Http\Request;

class SupportCommentController extends BaseController
{
    private static $repo = null;

    /**
     * @param $model
     * @return SupportCommentRepo|null
     */
    private static function getInstance($model)
    {
        self::$repo = new SupportCommentRepo($model);
        return self::$repo;
    }

    public function commentStore(SupportCommentRequest $request, $id)
    {
        try {
            $comment = $request->except('files');
            $comment['support_id'] = $id;
            $support = self::getInstance('SupportComment')->saveUpdate($comment);
            $support->name = $support->user->member->fullname();
            return $this->response("Comment added Successfully", ['comment' => $support], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateComment(SupportCommentRequest $request, $id)
    {
        try {

            $commnets = $request->except('files');
            $comment = SupportComment::find($id);
            $support = self::getInstance($comment)->saveUpdate($commnets);
            return $this->response("Comment update Successfully", ['comment' => $support], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function commentReplayStore(Request $request, $support, $comment)
    {
        try {
            $comments = $request->except('files');
            $comments['comment_id'] = $comment;
            $comments['support_id'] = $support;
//            dd($comments);
            $support = self::getInstance('SupportComment')->saveUpdate($comments);
            return $this->response("Reply added Successfully", ['comment_id' => $support->id], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function bestAnswer($id, SupportComment $comment, $from = '')
    {
        return view('default.support.crud.bestAnswer', compact('comment', 'id', 'from'));
    }
    public function solved($id, SupportComment $comment)
    {
        $comment->is_correct = true;
        $comment->save();
        return $this->response("Solved The issue", ['comment_id' => $comment->support_id], 200);
    }
    public function commentDelete($id, SupportComment $comment, $from = '')
    {
        return view('default.support.crud.commentDelete', compact('id', 'comment', 'from'));
    }
    public function deleteComment($id)
    {
        try {
            $comment = SupportComment::find($id);
            $support = self::getInstance($comment)->delete($id);
            return $this->response("Comment deleted Successfully", ['comment_id' => $support->id], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
