<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Queue;

class QueueTest extends TestCase
{
    public function testEnqueueAndEmpty()
    {
        $queue = new Queue();
        $this->assertSame(true, $queue->isEmpty());
        $queue->enqueue("abc", 999);
        $this->assertSame(false, $queue->isEmpty());
    }

    public function testPeek()
    {
        $queue = new Queue(8, 4, "331", "23085", 33);
        $this->assertSame(8, $queue->peek());
    }

    public function testDequeue()
    {
        $queue1 = new Queue("test", 32, "abc", 33, "abcde", 99);
        $queue2 = new Queue();
        $this->assertSame("test", $queue1->dequeue());
        $this->assertSame(32, $queue1->peek());
        $this->assertSame(null, $queue2->dequeue());
    }

    public function testTextRepresentation()
    {
        $queue = new Queue(5, 4, 3, 2, 1, "0");
        $this->assertSame("[5<-4<-3<-2<-1<-0]", $queue->__toString());
    }

    public function testCopy()
    {
        $queue = new Queue("abcde", 44, 88, "tests402", 75);
        $newQueue = $queue->copy();
        $this -> assertInstanceOf(Queue::class, $newQueue);
        $this -> assertSame(false, $newQueue->isEmpty());
        $this -> assertSame("abcde", $newQueue->peek());
    }
}
