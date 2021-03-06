<?php

defined('BASEPATH') OR exit('No script access allowed.');

class NewsModel extends CI_Model
{
  public function store($data = false)
  {
    if (!$data) 
    {
      return false;
    }

    return $this->db->insert('news', $data);
  }

  public function destroy($id = false)
  {
    if (!$id)
    {
      return false;
    }

    $this->db->where('id', $id);
    return $this->db->delete('news');
  }

  public function update($data = false, $id = false)
  {
    if (!$data || $id) 
    {
      return false;
    }

    $this->db->where('id', $id);
    return $this->update('news', $data);
  }

  public function get($id = false)
  {
    if ($id)
    {
      $this->db->where('id', $id);
    }

    $data = $this->db->get('news')->result();
    $result = [];
    
    foreach($data as $key => $item) 
    {
      $result[$key]['id'] = $item->id;
      $result[$key]['title'] = $item->title;
      $result[$key]['short_desc'] = $item->short_desc;
      $result[$key]['content'] = $item->content;
      $result[$key]['published'] = $item->published;
      $result[$key]['updated_at'] = $item->updated_at;

      $this->db->where('news_id', $item->id);
      $result[$key]['images'] = $this->db->get('new_images')->result_array();
    }

    return $result;
  }
}