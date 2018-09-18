<?php


/**
 * Class Queue
 */
class Queue
{
    /**
     * @var int 队头指针
     */
    private $_front;

    /**
     * @var int 队尾指针
     */
    private $_rear;

    /**
     * @var array 队列数组
     */
    private $_queue;

    /**
     * @var int 队列实际长度
     */
    private $_queueLength;

    /**
     * @var int 队列容量；
     */
    private $_queueSize;

    /**
     * Queue constructor.初始化队列
     * @param int $capacity 容量（循环队列的最大长度）
     */
    public function __construct($size)
    {
        $this->_queue = [];
        $this->_queueSize = $size;
        $this->_front = 0;
        $this->_rear = 0;
        $this->_queueLength = 0;
    }

    /**
     * 销毁队列；
     */
    public function __destruct()
    {
        unset($this->_queue);
    }

    /**
     * @method 入队
     * @param mixed $elem 入队的元素
     * @return bool
     */
    public function enQueue($elem)
    {
        if (!$this->isFull()) {
            $this->_queue[$this->_rear] = $elem;
            $this->_rear++;
            $this->_rear = $this->_rear % $this->_queueCapacity;
            $this->_queueLength++;
            return true;
        }
        return false;
    }

    /**
     * @method 出队
     * @return mixed|null
     */
    public function deQueue()
    {
        if (!$this->isEmpty()) {
            $elem = $this->_queue[$this->_front];
            //unset($this->_queue[$this->_front]);
            $this->_front++;
            $this->_front %= $this->_queueCapacity;
            $this->_queueLength--;
            return $elem;
        }
        return null;
    }

    /**
     * @method 判断队列是否为空；
     * @return bool
     */
    public function isEmpty()
    {
        return $this->_queueLength === 0;
    }

    /**
     * @method 判断队列是否饱和；
     * @return bool
     */
    public function isFull()
    {
        return $this->_queueLength === $this->_queueCapacity;
    }

    /**
     * @method 遍历队列并输出（测试队列）
     */
    public function outputQueue()
    {
        for ($i = $this->_front; $i < $this->_queueLength + $this->_front; $i++) {
            echo $this->_queue[$i % $this->_queueCapacity].PHP_EOL;
        }
    }

    /**
     * @method 清空队列
     */
    public function clearQueue()
    {
        $this->_queue = [];
        $this->_front = 0;
        $this->_rear = 0;
        $this->_queueLength = 0;
    }
}