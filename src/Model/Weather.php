<?php


namespace App\Model;


class Weather
{
    private $map = [
        1 => 'cloud',
        2 => 'cloud-rain',
        3 => 'sun'
    ];
    /**
     * @var integer
     */
    protected $dayTemp;
    /**
     * @var integer
     */
    protected $nightTemp;
    /**
     * @var int
     */
    protected $sky;
    /**
     * @var \DateTime
     */
    protected $date;
    /** @var string */
    protected $providerName;
    /**
     * @return string
     */
    public function getProviderName(): string
    {
        return $this->providerName;
    }
    /**
     * @param string $providerName
     */
    public function setProviderName($providerName): void
    {
        $this->providerName = $providerName;
    }
    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->map;
    }
    /**
     * @param array $map
     */
    public function setMap($map): void
    {
        $this->map = $map;
    }
    /**
     * @return int
     */
    public function getDayTemp(): int
    {
        return $this->dayTemp;
    }
    /**
     * @param int $dayTemp
     */
    public function setDayTemp($dayTemp): void
    {
        $this->dayTemp = $dayTemp;
    }
    /**
     * @return int
     */
    public function getNightTemp(): int
    {
        return $this->nightTemp;
    }
    /**
     * @param int $nightTemp
     */
    public function setNightTemp($nightTemp): void
    {
        $this->nightTemp = $nightTemp;
    }
    /**
     * @return int
     */
    public function getSky(): int
    {
        return $this->sky;
    }
    /**
     * @param int $sky
     */
    public function setSky($sky): void
    {
        $this->sky = $sky;
    }
    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }
    /**
     * @param \DateTime $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
}