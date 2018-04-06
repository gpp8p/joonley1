<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use MongoDB\Driver\Query;

class NestedCategory extends Model
{


public function findChildNodes($parentNodeName)
{
    if(!DB::table('nested_category')->where('name',$parentNodeName)->exists())
    {
        throw new Exception('Parent:'.$parentNodeName.' not found');
    }
    $query = <<<ENDQUERY
SELECT node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
FROM nested_category AS node,
        nested_category AS parent,
        nested_category AS sub_parent,
        (
                SELECT node.name, (COUNT(parent.name) - 1) AS depth
                FROM nested_category AS node,
                        nested_category AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                        AND node.name = '$parentNodeName'
                GROUP BY node.name
                ORDER BY node.lft
        )AS sub_tree
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
        AND sub_parent.name = sub_tree.name
GROUP BY node.name
HAVING depth <= 1
ORDER BY node.lft
ENDQUERY;


    $categoriesFound = DB::select($query, [$parentNodeName]);
    $returnValues = [];
    foreach($categoriesFound as $thisCategoryFound)
    {
        if($thisCategoryFound->depth>0)
        {
            $returnValues[] = $thisCategoryFound->name;
        }
    }
    return $returnValues;

}
    public function addCategory($name, $description, $parentNodeName)
    {
        if(!DB::table('nested_category')->where('name',$parentNodeName)->exists())
        {
            throw new Exception('Parent:'.$parentNodeName.' not found');
        }
        if(DB::table('nested_category')->where('name',$name)->exists())
        {
            throw new Exception('Category:'.$name.' already exists');
        }

        $nodeParent = DB::table('nested_category')->where('name',$parentNodeName)->first();
        try {
            $q1 = 'UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > ?';
            $q2 = 'UPDATE nested_category SET lft = lft + 2 WHERE lft > ?';
            DB::beginTransaction();
            DB::update($q1, [$nodeParent->lft]);
            DB::update($q2, [$nodeParent->lft]);
            $categoryId =DB::table('nested_category')->insertgetId([
                'name'=>$name,
                'description'=>$description,
                'lft'=>$nodeParent->lft+1,
                'rgt'=>$nodeParent->lft+2,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);
            DB::commit();


        } catch (Exception $e) {

            DB::rollBack();
            throw new Exception('Could not insert category:'.$e->getMessage());
        }
    }

    public function deleteCategory($nodeName)
    {
        if(!DB::table('nested_category')->where('name',$nodeName)->exists())
        {
            throw new Exception('Category:'.$nodeName.' not found');
        }

        $node = DB::table('nested_category')->where('name',$nodeName)->first();
        $leftPtr = $node->lft;
        $rightPtr = $node->rgt;
        $width = $rightPtr - $leftPtr + 1;

        $q1 = 'DELETE FROM nested_category WHERE lft BETWEEN '.$leftPtr.' AND '.$rightPtr;
        $q2 = 'UPDATE nested_category SET rgt = rgt - ? WHERE rgt > ?';
        $q3 = 'UPDATE nested_category SET lft = lft - ? WHERE lft > ?';

        try {
            DB::beginTransaction();
            $deleted = DB::delete($q1);
            $affected = DB::update($q2,[$width,$rightPtr]);
            $affected = DB::update($q3,[$width,$rightPtr]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not remove:'.$nodeName.' and sub categories because:'.$e->getMessage());
        }
        DB::commit();
        return $deleted;
    }

    public function immediateParent($nodeName)
    {
        $query = 'SELECT parent.name, parent.id FROM nested_category AS node, nested_category AS parent WHERE node.lft BETWEEN parent.lft AND parent.rgt AND node.name = ? ORDER BY parent.lft';
        $path =  DB::select($query, [$nodeName]);
        if((count($path)-2)>0) {
            return (array) $path[(count($path) - 2)];
        }else{
            return null;
        }
    }



}
